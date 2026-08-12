// === CONFIGURATION ===
const config = {
    scrollBehavior: 'smooth',
    scrollOffset: 80
};

// === UTILITIES ===
const $ = (selector) => document.querySelector(selector);
const $$ = (selector) => document.querySelectorAll(selector);

const scrollToSection = (sectionId) => {
    const section = $(`#${sectionId}`);
    if (!section) return;

    const yOffset = -config.scrollOffset;
    const y = section.getBoundingClientRect().top + window.pageYOffset + yOffset;

    window.scrollTo({
        top: y,
        behavior: config.scrollBehavior
    });
};

// === SIDEBAR NAVIGATION ===
const initSidebarNav = () => {
    const mobileMenuBtn = $('#mobile-menu-btn');
    const sidebar = $('#sidebar-nav');
    const overlay = $('#sidebar-overlay');

    if (!mobileMenuBtn || !sidebar || !overlay) return;

    const toggleSidebar = () => {
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    };

    mobileMenuBtn.addEventListener('click', toggleSidebar);
    overlay.addEventListener('click', toggleSidebar);

    $$('.nav-link').forEach((link) => {
        link.addEventListener('click', () => {
            if (window.innerWidth < 1430) {
                toggleSidebar();
            }
        });
    });
};

// === SCROLL BUTTONS ===
const initScrollButtons = () => {
    $$('.scroll-btn, button[data-scroll-to], .nav-link').forEach((btn) => {
        const target = btn.getAttribute('data-scroll-to');
        if (!target) return;

        btn.addEventListener('click', (e) => {
            e.preventDefault();
            scrollToSection(target);
        });
    });
};

// === ACTIVE LINK HIGHLIGHT ===
const initActiveLinks = () => {
    const observerOptions = {
        root: null,
        rootMargin: '-20% 0px -70% 0px',
        threshold: 0
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) return;

            const id = entry.target.id;
            $$('.nav-link').forEach((link) => {
                link.classList.remove('bg-blue-50', 'text-blue-600');
                if (link.getAttribute('data-scroll-to') === id) {
                    link.classList.add('bg-blue-50', 'text-blue-600');
                }
            });
        });
    }, observerOptions);

    const sectionIds = new Set();
    $$('button[data-scroll-to], .nav-link').forEach((btn) => {
        const target = btn.getAttribute('data-scroll-to');
        if (target) sectionIds.add(target);
    });

    sectionIds.forEach((id) => {
        const section = $(`#${id}`);
        if (section) observer.observe(section);
    });
};

// === GENERIC TAB SWITCHER ===
const initTabSwitcher = ({
    buttonSelector,
    dataAttribute,
    panelPrefix,
    defaultValue,
    activeClasses = ['bg-white', 'text-teal-800', 'font-bold']
}) => {
    const buttons = $$(buttonSelector);
    if (buttons.length === 0) return;

    const switchTo = (button) => {
        const value = button.getAttribute(dataAttribute);
        if (!value) return;

        buttons.forEach((btn) => {
            btn.classList.remove(...activeClasses);
            btn.classList.add('text-gray-700');
        });

        button.classList.add(...activeClasses);
        button.classList.remove('text-gray-700');

        $$(`[id^="${panelPrefix}"]`).forEach((panel) => panel.classList.add('hidden'));

        const targetPanel = $(`#${panelPrefix}${value}`);
        if (targetPanel) targetPanel.classList.remove('hidden');
    };

    buttons.forEach((btn) => {
        btn.addEventListener('click', () => switchTo(btn));
    });

    if (defaultValue) {
        const initialButton = document.querySelector(`${buttonSelector}[${dataAttribute}="${defaultValue}"]`);
        if (initialButton) {
            switchTo(initialButton);
            return;
        }
    }

    switchTo(buttons[0]);
};

// === INITIALIZATION ===
document.addEventListener('DOMContentLoaded', () => {
    initSidebarNav();
    initScrollButtons();
    initActiveLinks();

    initTabSwitcher({
        buttonSelector: '.year-btn',
        dataAttribute: 'data-year',
        panelPrefix: 'certifications-year-',
        defaultValue: '1'
    });

    initTabSwitcher({
        buttonSelector: '.epreuves-btn',
        dataAttribute: 'data-epreuve',
        panelPrefix: 'epreuve-',
        defaultValue: '5'
    });

    initTabSwitcher({
        buttonSelector: '.project-btn',
        dataAttribute: 'data-project-category',
        panelPrefix: 'projets-category-',
        defaultValue: 'bts'
    });
});
