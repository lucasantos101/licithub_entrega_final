// Wait for DOM content to load
document.addEventListener('DOMContentLoaded', () => {
    // Mobile Menu Toggle
    const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
    const navLinks = document.querySelector('.nav-links');
  
    if (mobileMenuBtn) {
      mobileMenuBtn.addEventListener('click', () => {
        mobileMenuBtn.classList.toggle('active');
        navLinks.classList.toggle('active');
        
        // Toggle menu button animation
        const spans = mobileMenuBtn.querySelectorAll('span');
        if (mobileMenuBtn.classList.contains('active')) {
          spans[0].style.transform = 'rotate(45deg) translate(6px, 6px)';
          spans[1].style.opacity = '0';
          spans[2].style.transform = 'rotate(-45deg) translate(6px, -6px)';
        } else {
          spans[0].style.transform = 'none';
          spans[1].style.opacity = '1';
          spans[2].style.transform = 'none';
        }
      });
    }
  
    // Close mobile menu when clicking a menu item
    const menuItems = document.querySelectorAll('.nav-links a');
    menuItems.forEach(item => {
      item.addEventListener('click', () => {
        navLinks.classList.remove('active');
        if (mobileMenuBtn.classList.contains('active')) {
          mobileMenuBtn.click();
        }
      });
    });
  
    // Header scroll effect
    const header = document.querySelector('.header');
    window.addEventListener('scroll', () => {
      if (window.scrollY > 50) {
        header.style.padding = '10px 0';
        header.style.boxShadow = '0 5px 15px rgba(0, 0, 0, 0.1)';
      } else {
        header.style.padding = '15px 0';
        header.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.05)';
      }
    });
  
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          window.scrollTo({
            top: target.offsetTop - 80,
            behavior: 'smooth'
          });
        }
      });
    });
  
    // Active menu item on scroll
    const sections = document.querySelectorAll('section[id]');
    window.addEventListener('scroll', () => {
      let current = '';
      sections.forEach(section => {
        const sectionTop = section.offsetTop - 100;
        const sectionHeight = section.offsetHeight;
        if (window.scrollY >= sectionTop && window.scrollY < sectionTop + sectionHeight) {
          current = section.getAttribute('id');
        }
      });
  
      document.querySelectorAll('.nav-links a').forEach(item => {
        item.classList.remove('active');
        if (item.getAttribute('href') === `#${current}`) {
          item.classList.add('active');
        }
      });
    });
  
    // Testimonial slider functionality
    const testimonialSlides = document.querySelectorAll('.testimonial-slide');
    const dots = document.querySelectorAll('.dot');
    let currentSlide = 0;
    const slideInterval = 5000; // 5 seconds
  
    function showSlide(index) {
      testimonialSlides.forEach(slide => {
        slide.classList.remove('active');
      });
      dots.forEach(dot => {
        dot.classList.remove('active');
      });
  
      testimonialSlides[index].classList.add('active');
      dots[index].classList.add('active');
      currentSlide = index;
    }
  
    // Initialize slider
    showSlide(0);
  
    // Auto slide
    let slideTimer = setInterval(() => {
      currentSlide = (currentSlide + 1) % testimonialSlides.length;
      showSlide(currentSlide);
    }, slideInterval);
  
    // Click on dots to change slide
    dots.forEach((dot, index) => {
      dot.addEventListener('click', () => {
        clearInterval(slideTimer);
        showSlide(index);
        slideTimer = setInterval(() => {
          currentSlide = (currentSlide + 1) % testimonialSlides.length;
          showSlide(currentSlide);
        }, slideInterval);
      });
    });
  
    // Counter animation
    const counters = document.querySelectorAll('.counter-number');
    const speed = 200; // Animation speed - higher is slower
  
    function animateCounters() {
      counters.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-count'));
        let count = 0;
        const increment = Math.ceil(target / speed);
        
        function updateCount() {
          if (count < target) {
            count += increment;
            if (count > target) count = target;
            counter.textContent = count;
            setTimeout(updateCount, 10);
          }
        }
        
        updateCount();
      });
    }
  
    // Check if element is in viewport
    function isInViewport(element) {
      const rect = element.getBoundingClientRect();
      return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
      );
    }
    
    // Trigger counter animation when counter section is in viewport
    const counterSection = document.querySelector('.counter-section');
    let animated = false;
    
    window.addEventListener('scroll', () => {
      if (counterSection && isInViewport(counterSection) && !animated) {
        animateCounters();
        animated = true;
      }
    });
    
    // Check on page load
    if (counterSection && isInViewport(counterSection)) {
      animateCounters();
      animated = true;
    }
  });

// Active menu item on scroll
const sections = document.querySelectorAll('section[id]');
window.addEventListener('scroll', () => {
  let current = '';
  sections.forEach(section => {
    const sectionTop = section.offsetTop - 100;
    const sectionHeight = section.offsetHeight;
    if (window.scrollY >= sectionTop && window.scrollY < sectionTop + sectionHeight) {
      current = section.getAttribute('id');
    }
  });

  document.querySelectorAll('.nav-links a').forEach(item => {
    item.classList.remove('active');
    if (item.getAttribute('href') === `#${current}`) {
      item.classList.add('active');
    }
  });
});



  