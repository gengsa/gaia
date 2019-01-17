import {
  find,
  isUndefined,
  round,
  toInteger,
  toNumber,
} from 'lodash';

function getId(code) {
  const currencyList = window.webData.currencyList;
  let id = 0;
  const currency = find(currencyList, c => c.cur_code === code);
  if (!isUndefined(currency)) {
    id = toInteger(currency.id);
  }
  return id;
}

function numberFormat(value, decimals, decPoint, thousandsSep) {
  let number = value;
  number = `${number}`.replace(/[^0-9+\-Ee.]/g, '');
  const n = !isFinite(+number) ? 0 : +number;
  const prec = !isFinite(+decimals) ? 0 : Math.abs(decimals);
  const sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep;
  const dec = (typeof decPoint === 'undefined') ? '.' : decPoint;
  let s = '';

  const toFixedFix = (num, prec2) => {
    const k = 10 ** prec2;
    return (Math.round(num * k) / k).toFixed(prec2);
  };

  // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : `${Math.round(n)}`).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array((prec - s[1].length) + 1).join('0');
  }

  return s.join(dec);
}

export const defaultCurrency = 'USD';

export function getRate(from, to) {
  let rate = 1;
  if (from === to) {
    return rate;
  }

  let founded = false;
  const currencyRateList = window.webData.currencyRateList;
  const fromId = getId(from);
  const toId = getId(to);
  const currencyRate = find(currencyRateList,
    cr => toInteger(cr.from_currency_id) === fromId && toInteger(cr.to_currency_id) === toId);
  if (!isUndefined(currencyRate)) {
    rate = toNumber(currencyRate.rate);
    founded = true;
  }
  if (founded === false) {
    const default2To = getRate(defaultCurrency, to);
    const default2From = getRate(defaultCurrency, from);
    rate = round(default2To / default2From, 4);
  }
  return rate;
}

export function currencyExchange(value, wighDigit = 2, currencyTo = null, withRate = null, currencyFrom = null) {
  if (value === null || isUndefined(value)) {
    return 0;
  }

  const currentCurrency = window.webData.currency;
  let to = currencyTo;
  let from = currencyFrom;
  let rate = withRate;
  let digit = wighDigit;

  if (to === null) {
    to = currentCurrency;
  }
  if (from === null) {
    from = defaultCurrency;
  }
  if (rate === null) {
    rate = getRate(from, to);
  }
  if (to === 'JPY') {
    digit = 0;
  }
  return round(value * rate, digit);
}

export function currencyFormat(value, wighDigit = 2, currencyTo = null, withRate = null, currencyFrom = null) {
  const exchangedValue = currencyExchange(value, wighDigit, currencyTo, withRate, currencyFrom);

  const currentCurrency = window.webData.currency;
  let to = currencyTo;
  let digit = wighDigit;
  if (to === null) {
    to = currentCurrency;
  }
  if (currencyTo === 'JPY') {
    digit = 0;
  }

  const currencyList = window.webData.currencyList;
  const currency = find(currencyList, { cur_code: to });
  if (isUndefined(currency)) {
    return toString(exchangedValue);
  }

  const formatedValue = numberFormat(exchangedValue, digit, currency.decimal, currency.thousand);
  return `${currency.cur_sign} ${formatedValue}`;
}

export default {
  currencyExchange,
  currencyFormat,
};
