function clearDisplay() {
    document.getElementById('display').innerText = '0';
}

function appendToDisplay(value) {
    const display = document.getElementById('display');
    const symbol = ['+', '-', '*', '/', '.', '%'];
    if (display.innerText == '0' && !(symbol.includes(value))) {
        display.innerText = value;
    } else {
        display.innerText += value;
    }
}

function deleteLast() {
    const display = document.getElementById('display');
    if (display.innerText.length > 1) {
        display.innerText = display.innerText.slice(0, -1);
    } else {
        display.innerText = '0';
    }
}

function calculateResult() {
    const display = document.getElementById('display');
    try {
      if (eval(display.innerText) == 'function Error() { [native code] }') {
        display.innerText = 'Error';
      }
      else {
        display.innerText = eval(display.innerText);
      }
    } catch {
        display.innerText = 'Error';
    }
}
