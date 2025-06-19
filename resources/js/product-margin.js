export default function setupProductMarginCalculation(purchaseValue, salePrice, profitMargin) {
    
    const costInput = document.getElementById(purchaseValue);
    const saleInput = document.getElementById(salePrice);
    const marginInput = document.getElementById(profitMargin);

    if (!costInput || !saleInput || !marginInput) return;

    function parseValue(value) {
        return parseFloat(value.replace(/\./g, '').replace(',', '.')) || 0;
    }

    function formatCurrency(value) {
        return value.toFixed(2).replace('.', ',');
    }

    saleInput.addEventListener('blur', function () {
        const cost = parseValue(costInput.value);
        const sale = parseValue(saleInput.value);

        console.log(cost);
        console.log(sale);

        if (cost > 0 && sale > 0) {
            const margin = ((sale - cost) / sale) * 100;
            marginInput.value = formatCurrency(margin);
        }
    });

    marginInput.addEventListener('blur', function () {
        const cost = parseValue(costInput.value);
        const margin = parseValue(marginInput.value);

        if (cost > 0 && margin > 0 && margin < 100) {
            const sale = cost / (1 - (margin / 100));
            saleInput.value = formatCurrency(sale);
        }
    });
}
