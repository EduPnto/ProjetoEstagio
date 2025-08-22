document.addEventListener('DOMContentLoaded', function () {
    const senhaInput = document.getElementById('senha');
    if (senhaInput) {
        const wrapper = document.createElement('div');
        wrapper.style.display = 'flex';
        wrapper.style.flexDirection = 'column';
        wrapper.style.alignItems = 'flex-end';
        senhaInput.parentNode.insertBefore(wrapper, senhaInput);
        wrapper.appendChild(senhaInput);

        senhaInput.style.paddingRight = ''; // Remove padding extra

        const eyeBtn = document.createElement('button');
        eyeBtn.type = 'button';
        eyeBtn.className = 'btn btn-outline-secondary btn-sm';
        eyeBtn.style.marginTop = '0.25rem';
        eyeBtn.style.border = 'none';
        eyeBtn.style.background = 'transparent';
        eyeBtn.style.padding = '0 0.5rem';
        eyeBtn.style.height = '24px';
        eyeBtn.style.display = 'flex';
        eyeBtn.style.alignItems = 'center';

        // SVG do olho (visível)
        const eyeIcon = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
        eyeIcon.setAttribute('width', '20');
        eyeIcon.setAttribute('height', '20');
        eyeIcon.setAttribute('fill', '#6c757d');
        eyeIcon.setAttribute('viewBox', '0 0 16 16');
        eyeIcon.innerHTML = `
            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM8 13c-2.5 0-4.71-1.61-6.39-4C3.29 6.61 5.5 5 8 5s4.71 1.61 6.39 4C12.71 11.39 10.5 13 8 13z"/>
            <path d="M8 5.5A2.5 2.5 0 1 0 8 10.5a2.5 2.5 0 0 0 0-5zM8 9a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
        `;

        // SVG do olho cortado (oculto)
        const eyeSlashIcon = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
        eyeSlashIcon.setAttribute('width', '20');
        eyeSlashIcon.setAttribute('height', '20');
        eyeSlashIcon.setAttribute('fill', '#6c757d');
        eyeSlashIcon.setAttribute('viewBox', '0 0 16 16');
        eyeSlashIcon.innerHTML = `
            <path d="M13.359 11.238C14.293 10.226 15 9 15 9s-3-5.5-8-5.5c-.795 0-1.56.09-2.29.26l1.518 1.518C6.09 5.09 7.045 5 8 5c2.5 0 4.71 1.61 6.39 4-.29.42-.62.82-.97 1.19l1.08 1.048z"/>
            <path d="M2.354 1.646a.5.5 0 1 0-.708.708l1.06 1.06C1.707 4.07 1 5.295 1 5.295s3 5.5 8 5.5c.795 0 1.56-.09 2.29-.26l1.518 1.518c-.73.17-1.495.26-2.29.26-5 0-8-5.5-8-5.5s.707-1.226 1.646-2.354l1.06 1.06z"/>
            <path d="M8 7a1 1 0 0 1 1 1c0 .265-.105.52-.293.707l1.147 1.147A2.5 2.5 0 0 0 8 6.5c-.265 0-.52.105-.707.293l1.147 1.147A1 1 0 0 1 8 7z"/>
            <path d="M13.646 14.354a.5.5 0 0 0 .708-.708l-12-12a.5.5 0 1 0-.708.708l12 12z"/>
        `;

        eyeBtn.appendChild(eyeIcon);
        wrapper.appendChild(eyeBtn);

        eyeBtn.addEventListener('click', function () {
            if (senhaInput.type === 'password') {
                senhaInput.type = 'text';
                eyeBtn.replaceChild(eyeSlashIcon, eyeIcon);
            } else {
                senhaInput.type = 'password';
                eyeBtn.replaceChild(eyeIcon, eyeSlashIcon);
            }
        });

        eyeBtn.addEventListener('mouseenter', function () {
            if (senhaInput.type === 'password') {
                eyeIcon.setAttribute('fill', '#000');
            } else {
                eyeSlashIcon.setAttribute('fill', '#000');
            }
        });
        eyeBtn.addEventListener('mouseleave', function () {
            if (senhaInput.type === 'password') {
                eyeIcon.setAttribute('fill', '#6c757d');
            } else {
                eyeSlashIcon.setAttribute('fill', '#6c757d');
            }
        });
    }
});
