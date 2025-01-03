let sidebar = document.querySelector('.admin-sidebar');

if(sidebar) {
    sidebar.innerHTML = `
         <div class="navbar navbar-expand-sm navbar-light shadow-sm  flex-column  ps-3 align-items-start" style="min-height: 100%; min-width: 300px; background-color: #2D3187;">
                <div class="navbar-brand">
                   <img src="../assets/img/logo-125.png" class="img-fluid" width="50px" alt="">
                   <label class="text-white">BMS</label>
                </div>
                
                <div class="navbar-nav">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="./main.html" class="nav-link text-light">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a href="./announcement.html" class="nav-link text-light">Announcement</a>
                        </li>
                        <li class="nav-item">
                            <a href="./residents.html" class="nav-link text-light">Residents</a>
                        </li>
                        <li class="nav-item">
                            <a href="./issuedClearance.html" class="nav-link text-light">Issued Clearance</a>
                        </li>
                        <li class="nav-item">
                            <a href="./documentRequest.html" class="nav-link text-light">Document Requests</a>
                        </li>
                        <li class="nav-item">
                            <a href="./officials.html" class="nav-link text-light">Officials</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link text-light">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
    
    `;
}