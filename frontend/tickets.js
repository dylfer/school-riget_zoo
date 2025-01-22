function incrementValue(id) {
    const input = document.getElementById(id);
    const currentValue = parseInt(input.value);
    if (currentValue < parseInt(input.max)) {
        input.value = currentValue + 1;
      }
  }

  function decrementValue(id) {
    const input = document.getElementById(id);
    const currentValue = parseInt(input.value);
    if (currentValue > parseInt(input.min)) {
      input.value = currentValue - 1;
    }
  }