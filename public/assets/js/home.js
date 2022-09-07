const api_key = '99fed424cd0db4aae7eb92fe37d27606'
const api_base_url = 'http://api.marketstack.com/v1/'

const dateExpireCookie = new Date();
dateExpireCookie.setDate(dateExpireCookie.getDate() + 1);
dateExpireCookie.setHours(0, 0, 0, 0);

function getCookie(user) {
    var cookieArr = document.cookie.split(";");
    for(var i = 0; i < cookieArr.length; i++) {
        var cookiePair = cookieArr[i].split("=");
        if(user == cookiePair[0].trim()) {
            return decodeURIComponent(cookiePair[1]);
        }
    }
    return null;
}

const get_symbols = (refresh) => {

    let cookieData = getCookie('symbols')
    if (refresh || !cookieData) {
        fetch(`${api_base_url}tickers/aapl/eod/latest?access_key=${api_key}`)
        .then(response => response.json())
        .then(data => {
            console.log(data)
            displayData(data, refresh)
            
            document.cookie = `symbols=${JSON.stringify(data)}; expires=${dateExpireCookie}`;
        })
        .catch(error => {
            console.log(error)
        })
    } else {
        console.log('cookieData');
        displayData(JSON.parse(cookieData))
    }
}

const displayData = (data, refresh) => {
    let {close, date, high, low, open, volume} = data
    date = new Date(date).toLocaleDateString()
    let array = {
        Date: date,
        Close: close,
        High: high,
        Low: low,
        Open: open,
        /* Volume: volume */
    }
    let list = document.getElementById('exchangeData')
    list.innerHTML = ""
    if (refresh) {
        setTimeout(() => {
            show()
        }, 1000)
    } else {
        show()
    } 
    
    function show () {
        Object.entries(array).forEach(entry => {
            const [key, value] = entry;
            let li = document.createElement('li')
            let span = document.createElement('div')
            span.innerText = key
            let span2 = document.createElement('span')
            span2.innerText = value
            li.appendChild(span)
            li.appendChild(span2)
            list.appendChild(li)
        })
    }
    
}

get_symbols()


const currencyExchange = (base, compare, refresh) => {
    let cookieData = getCookie('currencyExchange')
    if (refresh || !cookieData) {
        var myHeaders = new Headers();
        myHeaders.append("apikey", "6OHxiWpACunarnpcemXACOwo2rc8opeH");

        var requestOptions = {
            method: 'GET',
            redirect: 'follow',
            headers: myHeaders
        };

        fetch(`https://api.apilayer.com/exchangerates_data/latest?symbols=${compare}&base=${base}`, requestOptions)
            .then(response => response.json())
            .then(result => {
                displayCurrencyExchange(result, base, compare)
                document.cookie = `currencyExchange=${JSON.stringify(result)}; expires=${dateExpireCookie}`
                console.log(result)
            })
            .catch(error => console.log('error', error));
    }else {
        console.log('cookie2');
        displayCurrencyExchange(JSON.parse(cookieData), base, compare)
    }
}

const displayCurrencyExchange = (data, base, compare) => {
    current.innerText = data.base
    document.getElementById('compare').innerText = compare
    currency.innerText = compare
    value.innerText = Number.parseFloat(data.rates[compare]).toFixed(2)
    fluctuation(data.base, compare)
}


const fluctuation = (base, compare) => {
    const today = new Date().toLocaleDateString('en-CA')
    const yesterday = new Date(Date.now() - 86400000).toLocaleDateString('en-CA')

    let cookieData = getCookie('fluctuation')
    if (!cookieData) {
        var myHeaders = new Headers();
        myHeaders.append("apikey", "6OHxiWpACunarnpcemXACOwo2rc8opeH");

        var requestOptions = {
        method: 'GET',
        redirect: 'follow',
        headers: myHeaders
        };

        fetch(`https://api.apilayer.com/exchangerates_data/fluctuation?start_date=${today}&end_date=${yesterday}&symbols=${compare}&base=${base}`, requestOptions)
        .then(response => response.json())
        .then(result => {
            document.cookie = `fluctuation=${JSON.stringify(result)}; expires=${dateExpireCookie}`
            displayFluctuation(result, compare)
        })
        .catch(error => console.log('error', error));
    } else {
        console.log('cookie3');
        displayFluctuation(JSON.parse(cookieData), compare)
    }    
}

const displayFluctuation = (result, compare) => {
    parcent.innerText =  Number.parseFloat(result.rates[compare].change_pct).toFixed(2) + '%'
    if (result.rates[compare].change_pct < 0) {
        parcent.style.color = 'green'
    } else {
        parcent.style.color = 'red'
    }
}

currencyExchange('eur', 'USD')

// REFRESH DATA

const refreshTrade = document.getElementById('refreshTrade')
refreshTrade.addEventListener('click', () => {
    refreshTrade.classList.add('loadingData')
    get_symbols(true)
    setTimeout(() => {
        refreshTrade.classList.remove('loadingData')
    }, 2000)
})

const refreshChange = document.getElementById('refreshChange')
refreshChange.addEventListener('click', () => {
    refreshChange.classList.add('loadingData')
    currencyExchange('eur', 'USD', true)
    setTimeout(() => {
        refreshChange.classList.remove('loadingData')
    }, 2000)
}
)

// CHART

const labels = [
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
  ];

  const data = {
    labels: labels,
    datasets: [{
      label: 'My First dataset',
      backgroundColor: 'rgb(255, 99, 132)',
      borderColor: 'rgb(255, 99, 132)',
      data: [0, 10, 5, 2, 20, 30, 45],
    }]
  };

  const config = {
    type: 'line',
    data: data,
    options: {}
  };

  const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );

// ARABICA




const fetchApiArabica = (refresh) => {
    endpoint = 'latest'
    access_key = '0rh8p61gyroulhqb4x1hozku2v38uvp4713l863ot8cfxpet3yhemub19f1a';

    let cookieData = getCookie('arabica')
    if (refresh || !cookieData) {
        fetch('https://www.commodities-api.com/api/' + endpoint + '?access_key=' + access_key + '&base=usd&symbols=coffee,robusta,eur,gbp')
        .then(response => response.json())
        .then(data => {
            console.log(data)
            displayDataArabica(data, refresh)
            
            document.cookie = `arabica=${JSON.stringify(data)}; expires=${dateExpireCookie}`;
        })
        .catch(error => {
            console.log(error)
        })
    } else {
        console.log(cookieData);
        displayDataArabica(JSON.parse(cookieData))
    }
}

const displayDataArabica = (data, refresh) => {
    let {base, date, rates} = data.data
    date = new Date(date).toLocaleDateString()
    let arabica = rates.COFFEE
    let robusta = rates.ROBUSTA
    let currency = rates.EUR
    let arabicaToInitial = (1 / arabica) * 100000
    let robustaToInitial = (1 / robusta) * 1000
    let arabicaToCurrency = (1 / (arabica * currency )) * 2.205
    let robustaToCurrency = (1 / (robusta * currency )) / 1000
    let array = {
        Date: date,
        Initiale: new Intl.NumberFormat().format(arabicaToInitial.toFixed(2)) + ' cents/lb',
        Conversion: new Intl.NumberFormat().format(arabicaToCurrency.toFixed(2)) + ' €/kg'
    }
    let arrayRob = {
        Date: date,
        Initiale: new Intl.NumberFormat().format(robustaToInitial.toFixed(2)) + ' $/tonne',
        Conversion: new Intl.NumberFormat().format(robustaToCurrency.toFixed(2)) + ' €/kg'
    }
    const container = document.getElementById('arabicaData')
    container.innerHTML = ''
    const containerRob = document.getElementById('robustaData')
    containerRob.innerHTML = ''

    if (refresh) {
        setTimeout(() => {
            show()
        }, 1000)
    } else {
        show()
    } 

    function show () {
        Object.entries(array).forEach(entry => {
            const [key, value] = entry;
            let li = document.createElement('li')
            let span = document.createElement('div')
            span.innerText = key
            let span2 = document.createElement('span')
            span2.innerText = value
            li.appendChild(span)
            li.appendChild(span2)
            container.appendChild(li)
        })

        Object.entries(arrayRob).forEach(entry => {
            const [key, value] = entry;
            let li = document.createElement('li')
            let span = document.createElement('div')
            span.innerText = key
            let span2 = document.createElement('span')
            span2.innerText = value
            li.appendChild(span)
            li.appendChild(span2)
            containerRob.appendChild(li)
        })
    }

    
}

fetchApiArabica()

const refreshRobusta = document.getElementById('refreshRobusta')
const refreshArabica = document.getElementById('refreshArabica')
refreshRobusta.addEventListener('click', () => {
    refreshRobusta.classList.add('loadingData')
    fetchApiArabica(true)
    setTimeout(() => {
        refreshRobusta.classList.remove('loadingData')
    }, 2000)
})
refreshArabica.addEventListener('click', () => {
    refreshArabica.classList.add('loadingData')
    fetchApiArabica(true)
    setTimeout(() => {
        refreshArabica.classList.remove('loadingData')
    }, 2000)
})
