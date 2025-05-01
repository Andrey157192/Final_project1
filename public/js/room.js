document.addEventListener("DOMContentLoaded", () => {
  // Tombol kembali dengan efek scroll
  const backBtn = document.querySelector('.back-btn');
  if (backBtn) {
      backBtn.addEventListener('click', (e) => {
          e.preventDefault();
          window.scrollTo({ top: 0, behavior: 'smooth' });
          setTimeout(() => history.back(), 300);
      });
  }

  // Konfirmasi sebelum ke WhatsApp
  const bookBtn = document.querySelector('.book-btn');
  if (bookBtn) {
      bookBtn.addEventListener('click', (e) => {
          const confirmBooking = confirm("Ingin melanjutkan ke WhatsApp untuk pemesanan?");
          if (!confirmBooking) e.preventDefault();
      });
  }

  // Efek hover manual pada gambar
  const image = document.querySelector('.image-container img');
  if (image) {
      image.addEventListener('mouseenter', () => {
          image.style.transform = 'scale(1.05)';
      });
      image.addEventListener('mouseleave', () => {
          image.style.transform = 'scale(1)';
      });
  }

  // Info ukuran layar untuk debug (opsional)
  window.addEventListener('resize', () => {
      if (window.innerWidth < 600) {
          console.log('📱 Tampilan kecil');
      } else {
          console.log('🖥️ Tampilan besar');
      }
  });

  // Efek scroll untuk judul
  const header = document.querySelector('h1.title');
  if (header) {
      window.addEventListener('scroll', () => {
          if (window.scrollY > 10) {
              header.style.boxShadow = "0 2px 8px rgba(0,0,0,0.1)";
              header.style.backgroundColor = "#fff";
              header.style.padding = "1rem";
              header.style.borderRadius = "12px";
          } else {
              header.style.boxShadow = "none";
              header.style.backgroundColor = "transparent";
              header.style.padding = "0";
          }
      });
  }
});
