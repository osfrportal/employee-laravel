<?php

namespace Osfrportal\OsfrportalLaravel\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Process;
use Osfrportal\OsfrportalLaravel\Jobs\SfrCrlsUpdateJob;
use Illuminate\Support\Facades\Redis;

class SFRCrlsLoadCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sfr:crlsload';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load CRLS from WEB to DB';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->loadCrlsToDB();
    }

    private function loadCrlsToDB(): void
    {
        $crlFilesList = [
            '165591A65158C4892C6B515BD285190A01444822.crl' => 'http://cryptoplusupdateserver/Казначейство_России/',
            '1D8026D28962E704818F1E4AE8AB7292762DDD3D.crl' => 'http://cryptoplusupdateserver/Казначейство_России/',
            '29BCAFE2A52A511CF2681B677327A19D4573F415.crl' => 'http://cryptoplusupdateserver/Казначейство_России/',
            '5530F10C9C7743B224DC06592D5C01B671D46436.crl' => 'http://cryptoplusupdateserver/Казначейство_России/',
            'A70B95286F9FE44B8A5180B2851F894AFCE7F09C.crl' => 'http://cryptoplusupdateserver/Казначейство_России/',
            'C0D6D60A7D6B7EC98E39BCDA89FAAF942C585A8D.crl' => 'http://cryptoplusupdateserver/Казначейство_России/',
            'D064966D7240EB587D247FBB205BCFC38E6C7AD4.crl' => 'http://cryptoplusupdateserver/Казначейство_России/',
            //'0DA4BE6542FEC3FA3988CAABBAB7B38CE19CF0B0.crl' => 'http://cryptoplusupdateserver/ФНС_России/',
            //'13B64F4D7C2023ED600120A4029D00AF3F8FF7E4.crl' => 'http://cryptoplusupdateserver/ФНС_России/',
            //'163D4290BF0A9C881766B9264F928470A3D705DB.crl' => 'http://cryptoplusupdateserver/ФНС_России/',
            //'4E5C543B70FEFD74C7597304F2CACAD7967078E4.crl' => 'http://cryptoplusupdateserver/ФНС_России/',
            //'AC53BEAD76AC54D0880675D705C58B01B5ABBE94.crl' => 'http://cryptoplusupdateserver/ФНС_России/',
            //'C1836F3194B61E57BA10A847870A51E399CB07D0.crl' => 'http://cryptoplusupdateserver/ФНС_России/',
            //'D156FB382C4C55AD7EB3AE0AC66749577F87E116.crl' => 'http://cryptoplusupdateserver/ФНС_России/',
            //'DE66AE143C9B762894A66897749776B95C800324.crl' => 'http://cryptoplusupdateserver/ФНС_России/',
            //'E0ACA23183615A27AC05B888102FD46009B6FAE4.crl' => 'http://cryptoplusupdateserver/ФНС_России/',
            //'E91F07442C45B2CF599EE949E5D83E8382B94A50.crl' => 'http://cryptoplusupdateserver/ФНС_России/',
            //'EE3957BCAA22E0A7AC3FBE5E12F05407DDDE7D77.crl' => 'http://cryptoplusupdateserver/ФНС_России/',
            //'FCB21945F2BB7670B371B03CEE94381D4F975CD5.crl' => 'http://cryptoplusupdateserver/ФНС_России/',
        ];
        foreach ($crlFilesList as $crlFileName => $crlUrl) {
            $crlFullURL = sprintf("%s/%s", $crlUrl, $crlFileName);
            $response = Http::get($crlFullURL);
            if ($response->successful()) {
                $crlBody = $response->body();
                Storage::disk('crls')->put($crlFileName, $crlBody);
                $this->info(sprintf("File saved from URL %s", $crlFullURL));
            } else {
                $this->error(sprintf("FAILED download file from URL %s", $crlFullURL));
                //dump($response);
            }
        }
        $this->newLine(2);
        $crlFilesList = Storage::disk('crls')->files();
        foreach ($crlFilesList as $crlFileName) {
            $crlFileType = Storage::disk('crls')->mimeType($crlFileName);
            if ($crlFileType === 'application/pkix-crl') {
                $crlFilePath = Storage::disk('crls')->path($crlFileName);
                $this->info(sprintf("Process file %s", $crlFileName));
                set_time_limit(0);
                $opensslCrlLoadTextCommand = sprintf("openssl crl -noout -text -inform der -in %s 2>&1", $crlFilePath);
                $result = Process::run($opensslCrlLoadTextCommand);
                $crl_text = $result->output();
                if (!Str::contains($crl_text, 'No Revoked Certificates', true)) {
                    $crl_certificates = explode("Revoked Certificates:", $crl_text)[1];
                    $crl_certificates = explode("Serial Number:", $crl_certificates);
                    foreach ($crl_certificates as $key => $revoked_certificate) {
                        if (!empty($revoked_certificate) && $revoked_certificate[0] !== "\n") {
                            $revokeCertId = str_replace(" ", "", explode("\n", $revoked_certificate)[0]);
                            $revokeDate = str_replace("        Revocation Date: ", "", explode("\n", $revoked_certificate)[1]);
                            $jobData = [
                                'revokeCertId' => $revokeCertId,
                                'revokeDate' => $revokeDate,
                            ];
                            SfrCrlsUpdateJob::dispatch($jobData);
                        }
                    }
                } else {
                    $strMessage = sprintf("No certs in crl file %s", $crlFileName);
                    $this->info($strMessage);
                }
            } else {
                $this->info(sprintf("Unprocessed file type %s", $crlFileName));
                $this->newLine();
            }
            Storage::disk('crls')->delete($crlFileName);
            $this->info(sprintf("File %s deleted", $crlFileName));
            $this->newLine();
        }
        $this->info('The command was successful!');
    }
}
