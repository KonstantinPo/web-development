function calc() {
    let polishNotation = document.getElementById('polishNotationString').value;
    if (polishNotation !== '') {
        document.getElementById('polishNotationResult').innerHTML = calcImpl(polishNotation);
    }
}

function calcImpl(polishNotationString) {
    let lexems = parse(polishNotationString);
    let isExecuted = true;    
    while (lexems.length >= 3 && isExecuted) {
        isExecuted = false;
        polishNotationString = '';
        let i = 0;
        while (i < lexems.length - 2) {
            let res = tryExecute(lexems[i], lexems[i + 1], lexems[i + 2]);
            if (!res.result) {
                return res.value;
            }
            if (res.value !== null) {
                isExecuted = true;
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
        if (isExecuted) {
            lexems = polishNotationString.split(' ').filter(function(e) { return e.length != 0 });
        }

    }
    return !isNaN(Number(polishNotationString)) ? polishNotationString : 'Некорректная строка в польской нотации';    
}

function parse(string) {
    return string.split(' ').filter(function(e) {return e.length != 0});
}

function tryExecute(operator, operand1, operand2) {
    let res;
    switch(operator) {
        case '+':
            res = add(operand1, operand2);
            break;
        case '-':
            res = Sub(operand1, operand2);
            break;
        case '*':
            res = mul(operand1, operand2);
            break;
        case '/':
            res = div(operand1, operand2);
            break;
        default:
            return checkOperator(operator);
    }
    return {
        result: true,
        value: !isNaN(res) ? res : null,
    };
}

function checkOperator(operator) {
    return !isNaN(operator) ? {
        result: true,
        value: null,
    } : {
        result: false,
        value: 'Некорректный операнд в строке',
    };
}
function add(str1, str2) {
    let term1 = Number(str1);
    let term2 = Number(str2);
    return !isNaN(term1) && !isNaN(term2) ? term1 + term2 : null;
}

function sub(str1, str2) {
    let sub1 = Number(str1);
    let sub2 = Number(str2);
    return !isNaN(sub1) && !isNaN(sub2) ? sub1 - sub2 : null;
}

function mul(str1, str2) {
    let mul1 = Number(str1);
    let mul2 = Number(str2);
    return !isNaN(mul1) && !isNaN(mul2) ? mul1 * mul2 : null;
   
}

function div(str1, str2) {
    let dividend = Number(str1);
    let divisor = Number(str2);
    return !isNaN(dividend) && !isNaN(divisor) ? dividend / divisor : null;
}