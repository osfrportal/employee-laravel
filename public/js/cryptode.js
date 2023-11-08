const CRYPTODE_SYSTEM_ID = "portal.0058.pfr.ru";
const CRYPTODE_VERIFY_ONLY_GOST = true;
const CRYPTODE_USE_DEFAULT = false;

async function cryptoDEsessionInit(serial_numbers) {
    let urlInit = `http://localhost:3573/cryptoserver/init?verify_only_gost=${CRYPTODE_VERIFY_ONLY_GOST}&use_default=${CRYPTODE_USE_DEFAULT}&system_id=${CRYPTODE_SYSTEM_ID}&serial_numbers=${serial_numbers}`;
    let responseInit = await fetch(urlInit);
    let sessionIdInit = "";

    if (responseInit.ok) {
        let cryptoDEresponse = await responseInit.json();
        if (cryptoDEresponse.Success == 0) {
            sessionIdInit = cryptoDEresponse.Data.sessionId;
        } else {
            console.log("Ошибка инициализации сессии: " + cryptoDEresponse.Message);
        }
    } else {
        console.log("Ошибка HTTP: " + responseInit.status);
    }
    return sessionIdInit;
}

async function cryptoDEsessionCheck(sessionId) {
    console.log("Проверка сессии");
    let urlCheck = `http://localhost:3573/cryptoserver/check_session?session_id=${sessionId}`;
    let responseCheck = await fetch(urlCheck);

    if (responseCheck.ok) {
        let cryptoDEresponse = await responseCheck.json();
        if (cryptoDEresponse.Success == 0) {
            if (cryptoDEresponse.Data.isAlive == 1) {
                return true;
            }
        } else {
            console.log("Ошибка проверки сессии");
        }
    } else {
        console.log("Ошибка HTTP: " + responseCheck.status);
    }
    return false;
}

async function cryptoDEsignXML(sessionId, content) {
    console.log("Подписание XML");
    let urlSign = new URL('http://localhost:3573/cryptoserver/sign_xml');
    urlSign.searchParams.set('session_id', sessionId);
    urlSign.searchParams.set('content', content);
    urlSign.searchParams.set('content_type', '0');
    urlSign.searchParams.set('show_window_before', 'false');
    let responseSign = await fetch(urlSign);

    if (responseSign.ok) {
        let cryptoDEresponse = await responseSign.json();
        if (cryptoDEresponse.Success == 0) {
            return cryptoDEresponse.Data;
        } else {
            console.log("Ошибка подписи: " + cryptoDEresponse.Message);
            console.log("Ошибка подписи: " + cryptoDEresponse.Data);
        }
    } else {
        console.log("Ошибка HTTP: " + responseSign.status);
    }
    return false;
}
