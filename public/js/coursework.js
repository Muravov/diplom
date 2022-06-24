let courseWorkId;
let allParameters;
let studentName;
let parXSelect;
let parYSelect;
let currentUserParamsPair;
let parametersPairsArray = [];
let chartSubtitle = '';

let getParametersUrl = 'http://localhost:8000/get/parameters/name/';
let getParametersPair = 'http://localhost:8000/get/parameters/';

let singleComma = /.*(,).*/;
let leftBracket = /.*(\[).*/;

let excludedParameters = ["Тип судна [1]"];


window.addEventListener("load", function(event) {
    courseWorkId = courseworkId;
    getParams(courseWorkId);
});

async function getParams(courseWorkId){
    let url = getParametersUrl + courseWorkId;
    allParameters = await requestForParameters(url);

    parXSelect = document.getElementById('par1');
    parYSelect = document.getElementById('par2');
    fillSelectOptions(parXSelect, allParameters);
    fillSelectOptions(parYSelect, getYParameters());
    document.getElementById("chart_area_container").classList.remove("select-hidden");
}

function fillSelectOptions (selectObj, optionsArray){
    selectObj.options.length = 0;
    optionsArray.forEach(function(parameter){
        selectObj.options[selectObj.options.length] = new Option(capitalizeFirstLetter(parameter), parameter);
    });
}


function capitalizeFirstLetter(word){
    return word[0].toUpperCase() + word.substring(1);
}

function getYParameters(){
    let xValue = document.getElementById('par1').value;
    return allParameters.filter(p => p !== xValue).map(p => p);
}

async function requestForParametersPair (url){
    let response = await fetch(url);
    let json;

    if (response.ok) {
        json = await response.json();
    } else {
        alert("Ошибка HTTP: " + response.status);
    }

    return json;
}

async function requestForParameters (url){

    let response = await fetch(url);
    let json;
    let parameters;

    if (response.ok) {
        json = await response.json();
        parameters = clearParameterStrings(json);
    } else {
        alert("Ошибка HTTP: " + response.status);
    }

    return parameters;
}

function clearParameterStrings (parametersFromDb) {
    let parameters = [];
    let filteredParameters = parametersFromDb.filter(p => !excludedParameters.includes(p)).map(p => p);
    filteredParameters.forEach(function (param){
        let parameter = param;
        if(singleComma.test(param)){
            let lastCommaIndex = param.lastIndexOf(",");
            parameter = param.slice(0, lastCommaIndex);
        }
        if(!singleComma.test(param) && leftBracket.test(param)){
            let fistBracketIndex = param.indexOf("[");
            parameter = param.slice(0, fistBracketIndex);
        }
        parameters.push(parameter);
    });
    return parameters;
}

async function getChart(){

    studentName = document.getElementById('fio-handler').dataset['fioHandler'];

    let parameterXName = document.getElementById('par1').value;
    let parameterYName = document.getElementById('par2').value;

    let parametersPairUrl = getParametersPair + courseWorkId + '?parameter1=' + getIdByParameterName(courseWorkId, parameterXName)
        + '&parameter2=' + getIdByParameterName(courseWorkId, parameterYName);
    let parametersJson = await requestForParametersPair(parametersPairUrl);
    parametersJson.forEach(function(paramFromJson){
        if(paramFromJson.student !== studentName){
            parametersPairsArray.push(getNumbersFromString(paramFromJson.values));
        }
    })

    let currentUserParameters = JSON.parse(cwP);
    currentUserParamsPair = getNumbersFromString([currentUserParameters[getIdByParameterName(courseWorkId, parameterXName) - 1],
        currentUserParameters[getIdByParameterName(courseWorkId, parameterYName) - 1]]);
    chartSubtitle = parameterXName + ' - ' + parameterYName;

    renderChart();
}

function renderChart() {
    var renderTo = document.getElementById('chart_container');

    const chart = Highcharts.chart(renderTo, {
        chart: {
            type: 'scatter',
            zoomType: 'xy'
        },
        title: {
            text: 'Диаграмма'
        },
        subtitle: {
            text: chartSubtitle
        },
        series: [
            {
            name: 'Остальные',
            color: 'rgb(123,241,136)',
            data: parametersPairsArray
            },
            {
                name: studentName,
                color: '#0d6efd',
                data: [currentUserParamsPair]
            }
        ]
    });
}

function getNumbersFromString (stringPairArray){
    let numberPairArray = [];
    stringPairArray.forEach(function(stringValue){
        let dotStringValue = singleComma.test(stringValue) ? stringValue.replace(",", ".") : stringValue;
        numberPairArray.push(Number(dotStringValue));
    })
    return numberPairArray;
}

function getIdByParameterName (courseWorkId, parameterName){
    switch(courseWorkId){
        case 1: {
            switch(parameterName){
                case 'Мощность гл. турбины':
                    return 2;
                case 'Давление пара перед турбиной':
                    return 3;
                case 'Температура пара перед турбиной':
                    return 4;
                case 'Давление в главном конденсаторе':
                    return 5;
                case 'Число регенеративных ступеней подогрева ':
                    return 6;
                case 'Механический КПД турбины ':
                    return 7;
                case 'Давление пара перед сепаратором':
                    return 8;
                case 'Давление пара за сепаратором':
                    return 9;
                case 'Внутр. КПД баз. Турбины ':
                    return 10;
                case 'Внутр. теплоперепад баз. турбины':
                    return 11;
                case 'Расход пара без отборов':
                    return 12;
                case 'Конеч.влажность пара на выходе из ТВД ':
                    return 13;
                case 'Относ. внутр. кпд турбины ':
                    return 14;
                case 'Влажность пара на входе в конденсатор ':
                    return 15;
                case 'Давление в деаэраторе':
                    return 16;
                case 'Энтальпия питательной воды':
                    return 17;
                case 'Процент пара и тепла на доп. потребителя':
                    return 18;
                case 'Экономия от регенерации ':
                    return 19;
                case 'Расход пара на установку':
                    return 20;
                case 'Расход тепла на установку':
                    return 21;
                case 'Видимый расход пара на турбину':
                    return 22;
                case 'Колво влаги, отделенное в сепараторе':
                    return 23;
                case 'Колво пара, отбираемого всеми ступенями':
                    return 24;
                case 'Колво пара поступающего в конденса тор':
                    return 25;
                case 'Термический КПД установки ':
                    return 26;

            }
        }
        case 2: {
            switch(parameterName){
                case 'Мощность глав.турбины':
                    return 1;
                case 'Давление 1 контура':
                    return 2;
                case 'Температура ТН на входе в насос (выходе из парогенератора)':
                    return 3;
                case 'Число петель циркуляции':
                    return 4;
                case 'Напор ЦНПК':
                    return 5;
                case 'Подогрев теплоносителя в реакторе':
                    return 6;
                case 'Частота вращения':
                    return 7;
                case 'Термический КПД установки ':
                    return 8;
                case 'Число лопаток РК ':
                    return 9;
                case 'Коэффициент быстроходности насоса ':
                    return 10;
                case 'меридиальная скорость на входе в РК':
                    return 11;
                case 'меридиальная скорость на выходе из РК':
                    return 12;
                case 'Относительная скорость на входе в МЛП':
                    return 13;
                case 'Относительная скорость на выходе из МЛП':
                    return 14;
                case 'Окружная скорость на входе в МЛП':
                    return 15;
                case 'Окружная скорость на выходе из МЛП':
                    return 16;
                case 'Абсолютная скорость на выходе из МЛП':
                    return 17;
                case 'Угол лопатки на входе':
                    return 18;
                case 'Угол лопатки на выходе':
                    return 19;
                case 'Подача ГЦНПК':
                    return 20;
                case 'Полный КПД насоса ( из последней итерации) ':
                    return 21;
                case 'Диаметр входа в колесо':
                    return 22;
                case 'Диаметр расположения середины входных кромок':
                    return 23;
                case 'Наружный диаметр колеса':
                    return 24;
                case 'Ширина каналов МЛП на входе в РК':
                    return 25;
                case 'Ширина каналов МЛП на выходе из РК':
                    return 26;
                case 'Полезная мощность двигателя':
                    return 27;
                case 'Длина подшипника':
                    return 28;
                case 'Диаметр подшипника':
                    return 29;
                case 'Толщина стенки корпуса':
                    return 30;
            }
        }
        case 3: {
            switch(parameterName){
                case 'Мощность гл. турбины':
                    return 1;
                case 'давление пара перед турбиной':
                    return 2;
                case 'температура пара перед турбиной':
                    return 3;
                case 'Давление в главном конденсаторе':
                    return 4;
                case 'Видимый расход пара на турбину':
                    return 5;
                case 'Колво влаги, отделенное в сепараторе':
                    return 6;
                case 'Соотношение внутренних теплоперепадов по корпусам ':
                    return 7;
                case 'Относ. внутр. кпд турбины ':
                    return 8;
                case 'Относ.мощность ТВД ':
                    return 9;
                case 'Механический КПД турбины ':
                    return 10;
                case 'Внутренний кпд проточной части ':
                    return 11;
                case 'Мощность ТВД':
                    return 12;
                case 'Мощность ТНД':
                    return 13;
                case 'Суммарная мощность':
                    return 14;
                case 'Адиаб.теплоперепад ТВД':
                    return 15;
                case 'Адиаб.теплоперепад ТНД':
                    return 16;
                case 'Внутр.теплоперепад ТВД':
                    return 17;
                case 'Внутр.теплоперепад ТНД':
                    return 18;
                case 'Внутр.кпд ТВД ':
                    return 19;
                case 'Внутр.кпд ТНД ':
                    return 20;
                case 'Внутр.кпд корпусов ТВД ':
                    return 21;
                case 'Внутр.кпд корпусов ТНД ':
                    return 22;
                case 'Частота вращения ТВД':
                    return 23;
                case 'Число ступеней цилиндра ТВД ':
                    return 24;
                case 'Число ступеней цилиндра ТНД ':
                    return 25;
                case 'Диаметр первой ступени ТВД':
                    return 26;
                case 'Реактивность на среднем диаметре первой ступени ТВД ':
                    return 27;
                case 'Теплоперепад на первой ступени ТВД':
                    return 28;
                case 'Отношение скоростей на первой ступени ТВД ':
                    return 29;
                case 'Коэффициент удержания тепла ТВД ':
                    return 30;
                case 'Диаметр первой ступени ТНД':
                    return 31;
                case 'Теплоперепад на первой ступени ТНД':
                    return 32;
                case 'Отношение скоростей на первой ступени ТНД ':
                    return 33;
                case 'Коэффициент удержания тепла ТНД ':
                    return 34;
                case 'Расчётная мощность':
                    return 35;
                case 'Расчётный КПД проточной части ':
                    return 36;
            }
        }
        case 4: {
            switch(parameterName){
                case 'Мощность гл. турбины':
                    return 1;
                case 'Тепловая мощность реактора':
                    return 2;
                case 'Обогащение топлива':
                    return 3;
                case 'Наружный диаметр ТВЭ':
                    return 4;
                case 'Шаг расположения ТВЭ':
                    return 5;
                case 'Толщина оболочки ТВЭЛ':
                    return 6;
                case 'Количество ТВЭ ':
                    return 7;
                case 'Толщина стенки канала':
                    return 8;
                case 'Размер под ключ':
                    return 9;
                case 'Шаг расположения каналов':
                    return 10;
                case 'Средняя температура по реактору':
                    return 11;
                case 'Давление 1 контура':
                    return 12;
                case 'Диаметр канала (если не дан размер под ключ)':
                    return 13;
                case 'Тепловая мощность, снимаемая с метра длины':
                    return 14;
                case 'Температура нейтронного газа':
                    return 15;
                case 'Макроскопическое сечение поглощения':
                    return 16;
                case 'Макроскопическое сечение рассеяния':
                    return 17;
                case 'Макроскопическое сечение деления':
                    return 18;
                case 'Макроскопическое транпортное сечение':
                    return 19;
                case 'полное сечение':
                    return 20;
                case 'Количество нейтронов на 1 акт поглощения ураном235 нейтрона (гом) ':
                    return 21;
                case 'Коэффициент размножения на быстрых нейтронах (гом) ':
                    return 22;
                case 'Вероятность избежать резонансного поглощения (гом) ':
                    return 23;
                case 'Коэффициент использования тепловых нейтронов (гом) ':
                    return 24;
                case 'Вероятность избежать утечки нейтронов из реактора (гом) ':
                    return 25;
                case 'Количество нейтронов на 1 акт поглощения ураном235 нейтрона (гет) ':
                    return 26;
                case 'Коэффициент размножения на быстрых нейтронах (гет)':
                    return 27;
                case 'Вероятность избежать резонансного поглощения (гет)':
                    return 28;
                case 'Коэффициент использования тепловых нейтронов (гет) ':
                    return 29;
                case 'Вероятность избежать утечки нейтронов из реактора (гет) ':
                    return 30;
                case 'Радиус АЗ':
                    return 31;
                case 'Высота АЗ':
                    return 32;
                case 'Количество ячеек':
                    return 33;
                case 'Уточненное значение величины кампании реактора':
                    return 34;
                case 'Эффективный коэффициент размножения (гомогенный) ':
                    return 35;
                case 'Коэффициент размножения в бесконечной среде (гомогенный)':
                    return 36;
                case 'Эффективный коэффициент размножения (гетерог) ':
                    return 37;
                case 'Коэффициент размножения в бесконечной среде (гетерог) ':
                    return 38;
                case 'Средняя плотность потока нейтронов при ном. мощности':
                    return 39;
            }
        }
        case 5: {
            switch(parameterName){
                case 'Паропроизводительность одного ПГ':
                    return 1;
                case 'Температура пара перед турбиной':
                    return 2;
                case 'Давление пара перед турбиной':
                    return 3;
                case 'Давление 1 контура':
                    return 4;
                case 'Температура ТН 1 контура на входе в ПГ':
                    return 5;
                case 'Температура ТН на входе в насос (выходе из парогенератора)':
                    return 6;
                case 'Давление в деаэраторе':
                    return 7;
                case 'Число регенеративных ступеней подогрева ':
                    return 8;
                case 'Темпра питат.воды':
                    return 9;
                case 'Давление питат.воды':
                    return 10;
                case 'Тепловая мощность экономайзерного участка':
                    return 11;
                case 'Тепловая мощность испарительного участка':
                    return 12;
                case 'Тепловая мощность перегревательного участка':
                    return 13;
                case 'Температура ТН на входе в испарительный участок':
                    return 14;
                case 'Температура ТН на входе в экономайзерный участок':
                    return 15;
                case 'Скорость течения пит. воды эк. участка':
                    return 16;
                case 'Скорость течения пара внутри трубок перег. участка':
                    return 17;
                case 'Колво параллельно включенных трубок':
                    return 18;
                case 'Колво цилиндрических змеевиков':
                    return 19;
                case 'Внутренний диаметр обечайки трубной системы':
                    return 20;
                case 'Площадь поверхности теплопередачи эк.уч.':
                    return 21;
                case 'Площадь поверхности теплопередачи пуз. кип.':
                    return 22;
                case 'Площадь поверхности теплопередачи ухуд. тепл.':
                    return 23;
                case 'Площадь поверхности теплопередачи пер. уч.':
                    return 24;
                case 'Суммарная площадь теплопередачи':
                    return 25;
                case 'Высота навивки (акт. части)':
                    return 26;
                case 'Толщина стенки гладкой цилинд. обечайки':
                    return 27;

            }
        }
    }

}