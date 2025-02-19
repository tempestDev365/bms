let sidebar = document.querySelector(".admin-sidebar");

if (sidebar) {
  const logoPath = "../../assets/img/logo-125.png";
  
  sidebar.innerHTML = `
         <div class="navbar navbar-expand-sm navbar-light shadow-sm  flex-column  p-3 align-items-start" style="min-height: 100%; min-width: 300px; background-color: #2D3187;">
                <div class="navbar-brand">
                   <img src="${logoPath}" class="img-fluid" width="50px" alt="logo" 
                        onerror="this.onerror=null; this.src='../../assets/img/default-logo.png';">
                   <label class="text-white">Brgy. Sinbanali</label>
                </div>
                
                <div class="navbar-nav container-fluid">
                    <ul class="nav w-100 flex-column">
                        <li class="nav-item">
                            <a href="./main.php" class="nav-link text-light">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a href="./announcement.php" class="nav-link text-light">Announcement</a>
                        </li>

                       
                            <li class="nav-item">
                                <a href="./addResident.php" class="nav-link text-light">Add Residents</a>
                            </li>
                        

                            <li class="nav-item">
                                <a href="./residents.php" class="nav-link text-light">Registered Residents</a>
                            </li>




                      

                       

                       
                        <li class="nav-item">
                            <a href="./blotter.php" class="nav-link text-light">Blotter Schedule</a>
                        </li>
                        <li class="nav-item">
                            <a href="./documentRequest.php" class="nav-link text-light">Document Requests</a>
                        </li>
                        <li class="nav-item">
                            <a href="./officials.php" class="nav-link text-light">Officials</a>
                        </li>

                         <li class="nav-item">
                            <a href="./concerns.php" class="nav-link text-light">Concerns</a>
                        </li>

                        <li class="nav-item">
                            <a href="../../controllers/logoutController.php" class="nav-link text-light">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
    `;

  // Add hover and active styles
  const style = document.createElement('style');
  style.innerHTML = `
    .nav-link:hover {
      background-color: #1a1d6b;
    }
    .nav-link.active {
      background-color: #0d0f5a;
      font-weight: bold;
    }
  `;
  document.head.appendChild(style);

  // Set active link
  const currentPath = window.location.pathname.split('/').pop();
  const navLinks = sidebar.querySelectorAll('.nav-link');
  navLinks.forEach(link => {
    if (link.getAttribute('href') === `./${currentPath}`) {
      link.classList.add('active');
    }
  });
}

console.log("sidebar.js loaded");