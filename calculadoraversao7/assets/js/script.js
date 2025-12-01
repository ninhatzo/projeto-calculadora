function validaForm() {

    const campov1 = document.getElementById('valor1');
    const v1 = campov1.value.trim();
    const campov2 = document.getElementById('valor2');
    const v2 = campov2.value.trim();

    // Regex para o número (inteiro ou decimal. com sinal opcional)
    const numRegex = /^\s*[+-]?\d+(?:[\.,]\d+)?\s*$/;

    if (!numRegex.test(v1)) {
        alert('Por favor, insira um número válido!');
        campov1.focus();
        return false;
    } else if (!numRegex.test(v2)) {
        alert('Por favor, insira um número válido!');
        campov2.focus();
        return false;
    }
    return true;
}