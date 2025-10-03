// Wait for DOM
document.addEventListener("DOMContentLoaded", function () {

    // Highlight active nav link
    const current = window.location.pathname;
    document.querySelectorAll(".main-nav a").forEach(link => {
      if (link.getAttribute("href") === current) {
        link.classList.add("active");
      }
    });
  
    // Confirmation for delete links (admin pages)
    document.querySelectorAll("a[href*='delete=']").forEach(link => {
      link.addEventListener("click", function (e) {
        if (!confirm("Are you sure you want to delete this record?")) {
          e.preventDefault();
        }
      });
    });
  
    // Simple mobile nav toggle (optional)
    const navToggle = document.querySelector(".nav-toggle");
    if (navToggle) {
      navToggle.addEventListener("click", () => {
        document.querySelector(".main-nav ul").classList.toggle("open");
      });
    }
  
    // Smooth scroll for anchor links
    document.querySelectorAll("a[href^='#']").forEach(anchor => {
      anchor.addEventListener("click", function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute("href")).scrollIntoView({
          behavior: "smooth"
        });
      });
    });
  });

  document.addEventListener("DOMContentLoaded", () => {
    const navToggle = document.querySelector(".nav-toggle");
    const navMenu = document.querySelector(".main-nav ul");
  
    if (navToggle && navMenu) {
      navToggle.addEventListener("click", () => {
        navMenu.classList.toggle("open");
      });
    }
  });
  
  