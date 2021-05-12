function isPrimeNumber() {
  let polishNotation = document.getElementById('numbersString').value;
  if (polishNotation !== '') {
    let res = '';
    let numbers = polishNotation.split(' ').filter(function (e) { return e.length != 0 });
    for (let i = 0; i < numbers.length; i++) {
      res += numbers[i] + ' - ' + isPrimeNumberImpl(numbers[i]) + ' ';
    }
    isPrimeNumberImpl(polishNotation);
    document.getElementById('primeNumberResult').innerHTML = res;
  }
}

function isPrimeNumberImpl(string) {
  let value = parseInt(string);
  if (isNaN(value) || string != value) {
    return 'не является целым числом';
  }

  for (let i = 2; i <= value / 2; i++) {
    if (value % i === 0) {
      return 'не простое число';
    }
  }
  return 'простое число';
}