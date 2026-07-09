<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>E-Learning Dashboard</title>

  <!-- Font Awesome -->
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

  <style>
    *{
      margin:0;
      padding:0;
      box-sizing:border-box;
      font-family:Arial, Helvetica, sans-serif;
    }

    body{
      background:#bdbdbd;
    }

    .container{
      display:flex;
      min-height:100vh;
    }

    /* SIDEBAR */
    .sidebar{
      width:230px;
      background:linear-gradient(to bottom,#2e313d,#1d1e25);
      color:white;
      padding:20px 15px;
      position:relative;
    }

    .logo{
      display:flex;
      align-items:center;
      gap:10px;
      margin-bottom:30px;
      font-size:24px;
      font-weight:bold;
    }

    .logo i{
      font-size:28px;
    }

    .menu-title{
      font-size:12px;
      color:#cfcfcf;
      margin:20px 0 10px;
      text-transform:uppercase;
    }

    .menu{
      list-style:none;
    }

    .menu li{
      margin-bottom:10px;
    }

    .menu a{
      display:flex;
      align-items:center;
      gap:12px;
      text-decoration:none;
      color:white;
      padding:12px;
      border-radius:8px;
      transition:0.3s;
      font-size:14px;
    }

    .menu a:hover,
    .menu .active{
      background:#13d6c6;
    }

    hr{
      border:none;
      border-top:1px solid #777;
      margin:20px 0;
    }

    /* MAIN */
    .main{
      flex:1;
      padding:20px;
    }

    .topbar{
      display:flex;
      justify-content:space-between;
      align-items:center;
      margin-bottom:15px;
    }

    .breadcrumb{
      font-size:13px;
      color:#555;
    }

    .top-icons i{
      margin-left:15px;
      color:#555;
      cursor:pointer;
    }

    /* CARDS */
    .cards{
      display:grid;
      grid-template-columns:repeat(3,1fr) 1.3fr;
      gap:20px;
      margin-bottom:20px;
    }

    .card{
      background:white;
      border-radius:12px;
      overflow:hidden;
      box-shadow:0 3px 8px rgba(0,0,0,0.2);
    }

    .card-header{
      background:linear-gradient(to right,#111,#13d6c6);
      color:white;
      text-align:center;
      padding:10px;
      font-size:18px;
      font-weight:bold;
    }

    .card-body{
      display:flex;
      justify-content:space-around;
      padding:20px;
    }

    .card-body h2{
      margin-bottom:5px;
    }

    .small{
      font-size:12px;
      color:#888;
    }

    /* CONTENT */
    .content{
      display:grid;
      grid-template-columns:1fr 1fr 1.5fr;
      gap:20px;
    }

    .panel{
      background:linear-gradient(to right,#111,#2d2d33);
      color:white;
      border-radius:20px;
      padding:20px;
      min-height:450px;
      box-shadow:0 4px 10px rgba(0,0,0,0.3);
    }

    .panel h2{
      margin-bottom:20px;
    }

    /* MATERI */
    .materi-box{
      background:#2e2e36;
      padding:15px;
      border-radius:12px;
      margin-bottom:20px;
    }

    .materi-box h3{
      margin-bottom:8px;
    }

    .materi-box p{
      font-size:13px;
      margin:5px 0;
      color:#ddd;
    }

    .badge{
      display:inline-block;
      background:#44d62c;
      color:white;
      padding:3px 10px;
      border-radius:5px;
      font-size:11px;
      margin-top:5px;
    }

    /* JADWAL */
    .jadwal{
      display:flex;
      justify-content:space-between;
      margin-bottom:20px;
    }

    .jadwal h4{
      margin-bottom:5px;
    }

    .jadwal p{
      font-size:13px;
      color:#ddd;
      line-height:1.5;
    }

    /* PROGRESS */
    .progress-box{
      text-align:center;
      position:relative;
    }

    .circle{
      width:180px;
      height:180px;
      border-radius:50%;
      border:10px solid #0a1f66;
      border-top:10px solid #1ec8ff;
      margin:30px auto;
      display:flex;
      justify-content:center;
      align-items:center;
      position:relative;
    }

    .circle::before{
      content:'';
      position:absolute;
      width:130px;
      height:130px;
      background:#000;
      border-radius:50%;
    }

    .profile{
      width:90px;
      height:90px;
      border-radius:50%;
      overflow:hidden;
      z-index:2;
    }

    .profile img{
      width:100%;
      height:100%;
      object-fit:cover;
    }

    .filter-btn{
      position:absolute;
      right:0;
      top:0;
      background:#08153f;
      color:white;
      border:none;
      padding:8px 12px;
      border-radius:5px;
      cursor:pointer;
    }

    @media(max-width:1100px){
      .cards{
        grid-template-columns:1fr 1fr;
      }

      .content{
        grid-template-columns:1fr;
      }
    }

    @media(max-width:700px){
      .container{
        flex-direction:column;
      }

      .sidebar{
        width:100%;
      }

      .cards{
        grid-template-columns:1fr;
      }
    }

  </style>
</head>
<body>

<div class="container">

  <!-- SIDEBAR -->
  <div class="sidebar">

    <div class="logo">
      <i class="fa-solid fa-school"></i>
      <span>E-Learning</span>
    </div>

    <ul class="menu">
      <li>
        <a href="#" class="active">
          <i class="fa-solid fa-table-columns"></i>
          Dashboards
        </a>
      </li>

      <li>
        <a href="#">
          <i class="fa-solid fa-book"></i>
          Materi
        </a>
      </li>

      <li>
        <a href="#">
          <i class="fa-solid fa-house"></i>
          Smart Home
        </a>
      </li>
    </ul>

    <div class="menu-title">Pages</div>

    <ul class="menu">
      <li><a href="#"><i class="fa-solid fa-file"></i> Pages</a></li>
      <li><a href="#"><i class="fa-solid fa-table-cells"></i> Applications</a></li>
      <li><a href="#"><i class="fa-solid fa-cart-shopping"></i> Ecommerce</a></li>
      <li><a href="#"><i class="fa-solid fa-lock"></i> Authentication</a></li>
      <li><a href="#"><i class="fa-solid fa-circle-exclamation"></i> Error</a></li>
    </ul>

    <hr>

    <div class="menu-title">Docs</div>

  </div>

  <!-- MAIN -->
  <div class="main">

    <div class="topbar">

      <div>
        <div class="breadcrumb">
          Home / Pages / Dashboard
        </div>

        <h2>Dashboard</h2>
      </div>

      <div class="top-icons">
        <i class="fa-solid fa-user"></i>
        <i class="fa-solid fa-gear"></i>
        <i class="fa-solid fa-bell"></i>
      </div>

    </div>

    <!-- TOP CARDS -->
    <div class="cards">

      <div class="card">
        <div class="card-header">Materi</div>

        <div class="card-body">
          <div>
            <h2>10</h2>
            <div class="small">telah selesai</div>
          </div>

          <div>
            <h2>20</h2>
            <div class="small">total materi</div>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header">Tugas</div>

        <div class="card-body">
          <div>
            <h2>3</h2>
            <div class="small">saat ini</div>
          </div>

          <div>
            <h2>20</h2>
            <div class="small">total tugas</div>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header">Pertemuan</div>

        <div class="card-body">
          <div>
            <h2>10</h2>
            <div class="small">saat ini</div>
          </div>

          <div>
            <h2>120</h2>
            <div class="small">total pertemuan</div>
          </div>
        </div>
      </div>

    </div>

    <!-- CONTENT -->
    <div class="content">

      <!-- Materi -->
      <div class="panel">
        <h2>Materi Hari ini</h2>

        <div class="materi-box">
          <h3>Matematika</h3>
          <p><b>Judul Materi :</b> Operasi Bilangan Bulat</p>
          <p><b>Waktu :</b> 07.30 - 08.30</p>

          <span class="badge">LIHAT</span>
        </div>

        <div class="materi-box">
          <h3>Matematika</h3>
          <p><b>Judul Materi :</b> Operasi Bilangan Bulat</p>
          <p><b>Waktu :</b> 07.30 - 08.30</p>

          <span class="badge">LIHAT</span>
        </div>

        <div class="materi-box">
          <h3>Matematika</h3>
          <p><b>Judul Materi :</b> Operasi Bilangan Bulat</p>
          <p><b>Waktu :</b> 07.30 - 08.30</p>

          <span class="badge">LIHAT</span>
        </div>

      </div>

      <!-- Jadwal -->
      <div class="panel">
        <h2>Jadwal</h2>

        <div class="jadwal">
          <div>
            <h4>Senin</h4>
            <p>Matematika<br>Bahasa Indonesia<br>Seni Budaya</p>
          </div>

          <div>
            <p>
              07.30-07.50<br>
              07.30-07.50<br>
              07.30-07.50
            </p>
          </div>
        </div>

        <div class="jadwal">
          <div>
            <h4>Selasa</h4>
            <p>
              Matematika<br>
              Bahasa Indonesia<br>
              Seni Budaya
            </p>
          </div>

          <div>
            <p>
              07.30-07.50<br>
              07.30-07.50<br>
              07.30-07.50
            </p>
          </div>
        </div>

        <div class="jadwal">
          <div>
            <h4>Rabu</h4>
            <p>
              Matematika<br>
              Bahasa Indonesia<br>
              Seni Budaya
            </p>
          </div>

          <div>
            <p>
              07.30-07.50<br>
              07.30-07.50<br>
              07.30-07.50
            </p>
          </div>
        </div>

      </div>

      <!-- Progress -->
      <div class="panel progress-box">

        <button class="filter-btn">
          filter <i class="fa-solid fa-angle-down"></i>
        </button>

        <h3 style="text-align:left;">Progres Anda</h3>

        <div class="circle">
          <div class="profile">
            <img src="https://i.pravatar.cc/150?img=12">
          </div>
        </div>

      </div>

    </div>

  </div>

</div>

</body>
</html>