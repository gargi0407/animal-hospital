<?php
$pageTitle = "Home | Animal Hospital";
require_once "includes/header.php";
?>
<section class="hero">
  <div>
    <span class="eyebrow">A LITTLE CARE GOES A LONG WAY</span>
    <h2>Healthy pets.<br>Happy families.</h2>
    <p>Manage pet owners, pet profiles, veterinarians, appointments and treatments in one friendly place.</p>
    <a class="button" href="appointmentinfo.php">Explore appointments →</a>
    <p><strong>♥ Better care &nbsp; • &nbsp; Healthier pets &nbsp; • &nbsp; Happier families</strong></p>
  </div>
  <img src="https://images.unsplash.com/photo-1552053831-71594a27632d?auto=format&fit=crop&w=1000&q=85" alt="Happy dog outdoors">
</section>
<div class="section-title"><h2>Your hospital, all in one place</h2><p>Choose a section to view and manage records.</p></div>
<section class="grid">
  <article class="card"><img src="https://images.unsplash.com/photo-1548199973-03cce0bbc87b?auto=format&fit=crop&w=700&q=85" alt="Dogs with their owner"><div class="card-body"><h3>Pet Owners</h3><p>Manage owner names, contact details and addresses.</p><a class="button" href="ownerinfo.php">Manage Owners →</a></div></article>
  <article class="card"><img src="https://images.unsplash.com/photo-1573865526739-10659fec78a5?auto=format&fit=crop&w=700&q=85" alt="Cat"><div class="card-body"><h3>Pets</h3><p>Keep pet names, breeds and owner information organised.</p><a class="button" href="animalinfo.php">Manage Pets →</a></div></article>
  <article class="card"><img src="https://images.unsplash.com/photo-1628009368231-7bb7cfcb0def?auto=format&fit=crop&w=700&q=85" alt="Veterinary care"><div class="card-body"><h3>Veterinarians</h3><p>View veterinarian details and specialisations.</p><a class="button" href="vetinfo.php">View Vets →</a></div></article>
  <article class="card"><img src="https://images.unsplash.com/photo-1516734212186-a967f81ad0d7?auto=format&fit=crop&w=700&q=85" alt="Dog receiving care"><div class="card-body"><h3>Appointments</h3><p>Track scheduled visits and their status.</p><a class="button" href="appointmentinfo.php">Manage Appointments →</a></div></article>
  <article class="card"><img src="https://images.unsplash.com/photo-1576201836106-db1758fd1c97?auto=format&fit=crop&w=700&q=85" alt="Pet health check"><div class="card-body"><h3>Treatments</h3><p>View treatment and medical care records.</p><a class="button" href="treatmentinfo.php">View Treatments →</a></div></article>
</section>
<?php require_once "includes/footer.php"; ?>
