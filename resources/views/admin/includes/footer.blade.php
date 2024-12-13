

<script>
  const previewImage = e => {
      const reader = new FileReader();
      reader.readAsDataURL(e.target.files[0]);
      reader.onload = () => {
          const preview = document.getElementById('preview');
          preview.src = reader.result;
      };
  };
</script>

<footer class="footer">
  <div class="row">
      <div class="col-lg-6 text-center">
          <p class="mb-0 text-600">Thank you for creating with AashaTech<span class="d-none d-sm-inline-block">| </span><br class="d-sm-none"> 2022 © <a href="https://aashatech.com">AashaTech</a></p>
      </div>
  </div>
</footer>
