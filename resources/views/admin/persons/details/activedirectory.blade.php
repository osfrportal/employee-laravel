<div class="container-fluid px-4 mt-4">
    @dump($ad)
    @if (!is_null($ad))
        @dump($ad->getConvertedGuid())
    @endif
    @dump($SFRPersonData->persondata_adguid)
</div>
