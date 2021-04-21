function calc() {
    let polishNotation = document.getElementById('polishNotationString').value;
    if (polishNotation !== '') {
        document.getElementById('result').innerHTML = calcImpl(polishNotation);
    }
}

function calcImpl(polishNotationString) {
    let lexems = Parse(polishNotationString);
    isConverted = true;    
    while (lexems.length >= 3 && isConverted) {
        isConverted = false;
        polishNotationString = '';
        i = 0;
        while (i < lexems.length - 2) {
            res = TryExecute(lexems[i], lexems[i + 1], lexems[i + 2]);
            if (!res.result) {
                return res.value;
            }
            if (res.value !== null) {
                isConverted = true;
                polishNotationString += res.value + ' ';
                i += 3;
                continue;
            }
            polishNotationString += lexems[i] + ' ';
            i++;
        }
        for ( ; i < lexems.length; i++) {
            polishNotationString += lexems[i] + ' ';
        }
        if (isConverted) {
            lexems = polishNotationString.split(' ').filter(function(e) {return e.length != 0});
        }

    }
    return Number(polishNotationString) != NaN ? polishNotationString : 'Некорректная строка в польской нотации';    
}

function Parse(string) {
    return string.split(' ').filter(function(e) {return e.length != 0});
}

function TryExecute(operator, operand1, operand2) {
    let res;
    switch(operator) {
        case '+':
            res = Add(operand1, operand2);
            break;
        case '-':
            res = Sub(operand1, operand2);
            break;
        case '*':
            res = Mul(operand1, operand2);
            break;
        case '/':
            res = Div(operand1, operand2);
            break;
        default:
            return CheckOperator(operator);
    }
    return {
        result: true,
        value: !isNaN(res) ? res : null,
    };
}

function CheckOperator(operator) {
    if (!isNaN(operator)) {
        return {
            result: true,
            value: null,
        }
    } else {
        return {
            result: false,
            value: 'Некорректный операнд в строке',
        }
    }
}
function Add(str1, str2) {
    let term1 = Number(str1);
    let term2 = Number(str2);
    return term1 !== NaN && term2 !== NaN ? term1 + term2 : null;
}

function Sub(str1, str2) {
    let sub1 = Number(str1);
    let sub2 = Number(str2);
    return sub1 !== NaN && sub2 !== NaN ? sub1 - sub2 : null;
}

function Mul(str1, str2) {
    let mul1 = Number(str1);
    let mul2 = Number(str2);
    return mul1 !== NaN && mul2 !== NaN ? mul1 * mul2 : null;
   
}

function Div(str1, str2) {
    let dividend = Number(str1);
    let divisor = Number(str2);
    return dividend !== NaN && divisor !== NaN ? dividend / divisor : null;
}