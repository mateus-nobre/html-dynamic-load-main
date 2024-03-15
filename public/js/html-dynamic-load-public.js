document.addEventListener('DOMContentLoaded', () => {

console.log(dadosHtmlDynamicLoad);

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Carrega o conteúdo atual
                const dataId = parseInt(entry.target.getAttribute('data-id'), 10);
                loadContent(dataId);
                
                // Prepara para carregar o próximo conteúdo (+2 e +3, para manter dois carregamentos por vez)
                const nextDataId1 = dataId + 2;
                const nextDataId2 = dataId + 3;
                loadContent(nextDataId1);
                loadContent(nextDataId2);

                observer.unobserve(entry.target);

                // Prepara para observar o elemento após os próximos dois
                const nextPlaceholder = document.querySelector(`.lazy-html-placeholder[data-id="${nextDataId2 + 1}"]`);
                if (nextPlaceholder) {
                    nextPlaceholder.setAttribute('data-observed', 'true');
                    observer.observe(nextPlaceholder);
                }
            }
        });
    }, { threshold: 1.0 });

    // Função para carregar o conteúdo com base no data-id
    function loadContent(dataId) {
        const placeholder = document.querySelector(`.lazy-html-placeholder[data-id="${dataId}"]`);
        if (placeholder) {
            const templateContent = document.querySelector(`[data-template-id="${dataId}"]`).innerHTML;
            placeholder.innerHTML = templateContent;
            placeholder.removeAttribute('data-observed');
        }
    }

    // Inicialização: Armazena conteúdo, cria placeholders, e inicia observação a partir do quarto elemento
    const lazyElements = document.querySelectorAll('.lazy-html');
    lazyElements.forEach((element, index) => {
        const dataId = index + 1;
        const template = document.createElement('script');
        template.type = 'text/template';
        template.setAttribute('data-template-id', dataId);
        template.innerHTML = element.outerHTML;
        document.body.appendChild(template);

        // Substitui elementos por placeholders
        const placeholder = document.createElement('div');
        placeholder.classList.add('lazy-html-placeholder');
        placeholder.setAttribute('data-id', dataId);
        if (index >= 3) {
            element.parentNode.replaceChild(placeholder, element);
            if (index === 3) { // Observa o quarto elemento para iniciar o processo
                placeholder.setAttribute('data-observed', 'true');
                observer.observe(placeholder);
            }
        } else {
            element.outerHTML = template.innerHTML;
        }
    });
});
