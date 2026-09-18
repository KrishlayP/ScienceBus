import { animate, stagger } from 'https://cdn.jsdelivr.net/npm/animejs@4.4.1/+esm';

const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
const animatedElements = new WeakSet();
const interactiveElements = new WeakSet();

function uniqueElements(root, selector) {
  return [...new Set([...root.querySelectorAll(selector)])];
}

function animateEntrance(elements, options = {}) {
  const fresh = elements.filter((element) => !animatedElements.has(element));
  if (!fresh.length) return;

  fresh.forEach((element) => animatedElements.add(element));
  if (reducedMotion) return;

  animate(fresh, {
    opacity: { from: 0 },
    y: { from: options.y ?? 18 },
    scale: { from: options.scale ?? 0.985 },
    duration: options.duration ?? 650,
    delay: stagger(options.stagger ?? 70, { start: options.delay ?? 0 }),
    ease: 'out(4)'
  });
}

function bindCardMotion(element) {
  if (interactiveElements.has(element) || reducedMotion) return;
  interactiveElements.add(element);

  element.addEventListener('mouseenter', () => {
    animate(element, { y: -4, scale: 1.012, duration: 260, ease: 'out(3)' });
  });
  element.addEventListener('mouseleave', () => {
    animate(element, { y: 0, scale: 1, duration: 320, ease: 'out(4)' });
  });
}

function bindFormMotion(form) {
  if (interactiveElements.has(form) || reducedMotion) return;
  interactiveElements.add(form);

  form.addEventListener('focusin', () => {
    animate(form, { scale: 1.004, duration: 260, ease: 'out(3)' });
  });
  form.addEventListener('focusout', (event) => {
    if (form.contains(event.relatedTarget)) return;
    animate(form, { scale: 1, duration: 300, ease: 'out(4)' });
  });
}

function bindRowMotion(row) {
  if (interactiveElements.has(row) || reducedMotion) return;
  interactiveElements.add(row);

  row.addEventListener('mouseenter', () => {
    animate(row, { x: 4, duration: 220, ease: 'out(3)' });
  });
  row.addEventListener('mouseleave', () => {
    animate(row, { x: 0, duration: 260, ease: 'out(4)' });
  });
}

function initializeAnimations(root = document) {
  const surfaces = uniqueElements(root, '.admin-card, .admin-surface');
  const standaloneForms = uniqueElements(root, 'form').filter((form) => !form.classList.contains('admin-surface'));
  const tables = uniqueElements(root, 'table');
  const rows = uniqueElements(root, 'tbody tr');

  animateEntrance(surfaces, { y: 20, stagger: 80 });
  animateEntrance(standaloneForms, { y: 16, stagger: 60, delay: 80 });
  animateEntrance(tables, { y: 12, scale: 0.995, stagger: 50, delay: 120 });
  animateEntrance(rows, { y: 8, scale: 1, stagger: 35, delay: 150, duration: 480 });

  surfaces.forEach(bindCardMotion);
  uniqueElements(root, 'form').forEach(bindFormMotion);
  rows.forEach(bindRowMotion);
}

document.addEventListener('DOMContentLoaded', () => {
  initializeAnimations();

  const observer = new MutationObserver((mutations) => {
    const roots = mutations
      .flatMap((mutation) => [...mutation.addedNodes])
      .filter((node) => node.nodeType === Node.ELEMENT_NODE);

    roots.forEach((root) => {
      initializeAnimations(root.parentElement || root);
    });
  });

  observer.observe(document.querySelector('main') || document.body, {
    childList: true,
    subtree: true
  });
});
