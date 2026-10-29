
<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

if (!isset($pageTitle)) {
    $pageTitle = "Animal Hospital Management System";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= htmlspecialchars($pageTitle) ?></title>
<style>
:root{--green:#28583e;--green2:#477b51;--cream:#fbf8ef;--sage:#e8f0df;--ink:#203c31;--muted:#63736a;--line:#dce6d9}
*{box-sizing:border-box}
body{margin:0;background:linear-gradient(180deg,#fbf8ef,#f3f6ee);color:var(--ink);font:16px/1.6 "Trebuchet MS",Arial,sans-serif}
.site-header{display:flex;align-items:center;justify-content:space-between;gap:18px;padding:16px clamp(14px,4vw,48px);background:#fff;border-bottom:1px solid var(--line)}
.brand{display:flex;align-items:center;gap:12px}
.logo{display:grid;place-items:center;width:50px;height:50px;border-radius:16px;background:linear-gradient(135deg,var(--green),#83aa69);font-size:26px;color:#fff;box-shadow:0 7px 16px #28583e20}
.brand h1{margin:0;color:var(--green);font-size:22px;line-height:1.2}.brand small{color:var(--muted)}
nav{display:flex;gap:4px;justify-content:center;flex-wrap:wrap}
nav a{padding:8px 11px;border-radius:20px;text-decoration:none;color:var(--ink);font-size:13px;font-weight:bold}
nav a:hover{background:var(--sage)}
main{width:min(1160px,calc(100% - 28px));min-height:62vh;margin:26px auto 42px}
.hero{display:grid;grid-template-columns:1.1fr .9fr;gap:28px;align-items:center;padding:clamp(24px,4vw,48px);background:linear-gradient(115deg,#edf4df,#fffaf0 60%,#dcebd0);border:1px solid #e3ebd9;border-radius:24px;margin-bottom:28px}
.eyebrow{display:inline-block;background:#dcebd0;padding:6px 12px;border-radius:20px;color:var(--green);font-weight:bold;font-size:12px;letter-spacing:.7px}
.hero h2{font-size:clamp(30px,4vw,48px);line-height:1.1;color:var(--green);margin:12px 0}
.hero p{color:#52655a}.hero img{width:100%;height:290px;object-fit:cover;object-position:center 30%;border-radius:45% 18px 45% 18px;box-shadow:0 14px 30px #244c3020}
.section-title{text-align:center;margin:25px 0 18px}.section-title h2{margin:0;color:var(--green)}
.grid{display:grid;grid-template-columns:repeat(6,minmax(0,1fr));gap:18px}
.card{grid-column:span 2;overflow:hidden;background:#fff;border:1px solid var(--line);border-radius:17px;box-shadow:0 8px 24px #244c3010;transition:transform .2s}
.card:hover{transform:translateY(-3px)}.card:nth-child(4){grid-column:2/span 2}.card:nth-child(5){grid-column:4/span 2}
.card img{width:100%;height:175px;object-fit:cover;display:block}.card-body{padding:18px}.card h3{margin:0;color:var(--green)}.card p{color:var(--muted);font-size:14px}
.button,button,input[type=submit]{display:inline-block;border:0;border-radius:8px;background:var(--green2);color:#fff;padding:10px 15px;text-decoration:none;font:inherit;font-weight:bold;cursor:pointer}
.button:hover,button:hover,input[type=submit]:hover{background:var(--green)}
form{max-width:760px;margin:18px auto;padding:22px;background:#fff;border:1px solid var(--line);border-radius:15px;box-shadow:0 8px 22px #244c3010}
label{display:block;margin:12px 0 5px;font-weight:bold;color:var(--green)}
input:not([type=submit]),select,textarea{width:100%;padding:10px 12px;border:1px solid #cbd8cc;border-radius:8px;font:inherit;background:#fff}
textarea{min-height:90px}
.table-wrap{overflow-x:auto;background:#fff;border-radius:12px;box-shadow:0 7px 20px #244c3010;margin:18px 0}
table{width:100%;border-collapse:collapse}th,td{padding:11px 12px;text-align:left;border-bottom:1px solid var(--line);white-space:nowrap}th{background:var(--green);color:#fff}tr:nth-child(even) td{background:#f5f8f1}
.actions{display:flex;gap:7px;align-items:center}.small-button{padding:6px 10px;font-size:13px;border-radius:6px;text-decoration:none;color:#fff;background:var(--green2)}.delete-button{background:#b84b45}
.notice,.error{padding:12px 15px;border-radius:9px;margin:14px 0}.notice{background:#e8f0df;color:var(--green)}.error{background:#fff0ed;color:#8a2f20}
footer{background:var(--green);color:white;text-align:center;padding:21px 12px;font-size:13px}footer p{margin:0}
@media(max-width:900px){.site-header{flex-direction:column}.hero{grid-template-columns:1fr}.hero img{height:240px}.grid{grid-template-columns:repeat(2,minmax(0,1fr))}.card,.card:nth-child(4),.card:nth-child(5){grid-column:auto}}
@media(max-width:580px){main{width:calc(100% - 20px);margin-top:16px}.brand h1{font-size:19px}nav a{font-size:12px;padding:7px 8px}.hero{padding:21px}.hero img{height:200px}.grid{grid-template-columns:1fr}.card,.card:nth-child(4),.card:nth-child(5){grid-column:auto}.card img{height:190px}form{padding:16px}th,td{padding:9px}}
</style>
</head>
<body>
<header class="site-header">
  <div class="brand"><div class="logo">🐾</div><div><h1>Animal Hospital</h1><small>Management System</small></div></div>
  <nav>
    <a href="index.php">⌂ Home</a>
    <a href="ownerinfo.php">Pet Owners</a>
    <a href="animalinfo.php">Pets</a>
    <a href="vetinfo.php">Veterinarians</a>
    <a href="appointmentinfo.php">Appointments</a>
    <a href="treatmentinfo.php">Treatments</a>
  </nav>
</header>
<main>
