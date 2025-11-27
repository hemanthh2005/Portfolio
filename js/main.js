// small helpers
document.getElementById('year').textContent = new Date().getFullYear();

// mobile nav toggle
const mobileBtn = document.getElementById('mobile-menu-btn');
mobileBtn && mobileBtn.addEventListener('click', () => {
    const nav = document.querySelector('.nav');
    if (nav.style.display === 'block') nav.style.display = '';
    else nav.style.display = 'block';
});

// load XML + XSLT projects
async function loadProjects() {
    try {
        const [xmlResp, xslResp] = await Promise.all([
            fetch('xml/project.xml'),
            fetch('xml/project.xsl')
        ]);
        if (!xmlResp.ok) throw new Error('Missing project.xml');
        if (!xslResp.ok) throw new Error('Missing project.xsl');

        const xmlText = await xmlResp.text();
        const xslText = await xslResp.text();

        const parser = new DOMParser();
        const xml = parser.parseFromString(xmlText, 'application/xml');
        const xsl = parser.parseFromString(xslText, 'application/xml');

        if (window.XSLTProcessor) {
            const proc = new XSLTProcessor();
            proc.importStylesheet(xsl);
            const frag = proc.transformToFragment(xml, document);
            const grid = document.getElementById('projects-grid');
            grid.innerHTML = '';
            grid.appendChild(frag);

            // add click handlers for project cards
            // document.querySelectorAll('.project-card').forEach(card => {
            //     card.addEventListener('click', () => {
            //         const title = card.querySelector('.project-title').textContent;
            //         const desc = card.querySelector('.project-desc').textContent;
            //         openModal(`<h3>${title}</h3><p>${desc}</p>`);

            //     });
            // });

            document.querySelectorAll('.project-card').forEach(card => {
                card.addEventListener('click', () => {
                    const link = card.querySelector('.project-link').textContent;
                    if (link) {
                        window.open(link, "_blank");
                    }
                });
            });



        } else {
            document.getElementById('projects-grid').textContent = 'XSLT not supported in this browser.';
        }
    } catch (err) {
        document.getElementById('projects-grid').textContent = 'Error loading projects.';
        console.error(err);
    }
}
loadProjects();

// modal helpers
const modal = document.getElementById('modal');
const modalBody = document.getElementById('modal-body');
const modalClose = document.getElementById('modal-close');
function openModal(html) {
    modalBody.innerHTML = html;
    modal.setAttribute('aria-hidden', 'false');
}
function closeModal() {
    modal.setAttribute('aria-hidden', 'true');
    modalBody.innerHTML = '';
}
modalClose && modalClose.addEventListener('click', closeModal);
modal.addEventListener('click', (e) => {
    if (e.target === modal) closeModal();
});

// contact form UX
const contactForm = document.getElementById('contact-form');
const status = document.getElementById('form-status');
if (contactForm) {
    contactForm.addEventListener('submit', (e) => {
        // let Formspree handle submission; show friendly message
        status.textContent = 'Sending…';
        setTimeout(() => status.textContent = 'If the form doesn’t redirect, check your Formspree inbox.', 1200);
    });
}
