// Util function
function addFormatter (input, formatFn, callback) {
    let oldValue = input.value;
    
    const handleInput = event => {
      const result = formatFn(input.value, oldValue, event);
      if (typeof result === 'string') {
        input.value = result;
      }
      
      oldValue = input.value;
  
      if (callback !== undefined) {
        callback(input, result)
      }
    }
  
    handleInput();
    input.addEventListener("input", handleInput);
  }
  
  // Example implementation
  // HOF returning regex prefix formatter
  function createRegexFormatter (regex, defaultValue) {
    return (newValue, oldValue) => regex.test(newValue)
      ? newValue
      : (newValue ? oldValue : defaultValue);
  }
  
  // Input field
  const input = document.getElementById('prefix');
  
  // Prefix formatter
  addFormatter(input, createRegexFormatter(/^https?:\/\//, 'http://'));
  
  // Postfix formatter
  const input2 = document.getElementById('postfix');
  
  addFormatter(input2, createRegexFormatter(/\.com$/, '.com'), input => {
    // input.focus();
    const pos = Math.max(0, input.value.length - 4)
    input.setSelectionRange(pos, pos);
  });
  