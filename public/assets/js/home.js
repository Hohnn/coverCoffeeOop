const api_key = '99fed424cd0db4aae7eb92fe37d27606'
const api_base_url = 'http://api.marketstack.com/v1/'

const get_symbols = () => {
    fetch(`${api_base_url}tickers/aapl/eod/latest?access_key=${api_key}`)
    .then(response => response.json())
    .then(data => {
        console.log(data)
        displayData(data)
    })
    .catch(error => {
        console.log(error)
    })
}
get_symbols()

const displayData = (data) => {
    let {close, date, high, low, open, volume} = data
    date = new Date(date).toLocaleDateString()
    let array = {
        Date: date,
        Close: close,
        High: high,
        Low: low,
        Open: open,
        Volume: volume
    }
    let list = document.getElementById('exchangeData')
    Object.entries(array).forEach(entry => {
        const [key, value] = entry;
        let li = document.createElement('li')
        li.innerText = `${key}: ${value}`
        list.appendChild(li)
    })
}

const currencyExchange = (base, compare) => {
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
            console.log(result)})
        .catch(error => console.log('error', error));
}

const displayCurrencyExchange = (data, base, compare) => {
    current.innerText = data.base
    compare.innerText = compare
    currency.innerText = compare
    value.innerText = data.rates[compare].toFixed(4)
    fluctuation(data.base, compare)
}


const fluctuation = (base, compare) => {
    const today = new Date().toLocaleDateString('en-CA')
    const yesterday = new Date(Date.now() - 86400000).toLocaleDateString('en-CA')
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
        parcent.innerText = result.rates[compare].change_pct.toFixed(2) + '%'
        if (result.rates[compare].change_pct < 0) {
            parcent.style.color = 'green'
        } else {
            parcent.style.color = 'red'
        }
    })
    .catch(error => console.log('error', error));
}

currencyExchange('eur', 'usd')