let sidebar = document.querySelector('.admin-sidebar');

if(sidebar) {
    sidebar.innerHTML = `
         <div class="navbar navbar-expand-sm navbar-light shadow-sm border flex-column  ps-3 align-items-start" style="min-height: 100vh; min-width: 300px;">
                <div class="navbar-brand">
                   <img src="../assets/img/logo-125.png" class="img-fluid" width="50px" alt="">
                   <label>BMS</label>
                </div>
                
                <div class="navbar-nav">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="./main.html" class="nav-link">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a href="./announcement.html" class="nav-link">Announcement</a>
                        </li>
                        <li class="nav-item">
                            <a href="./residents.html" class="nav-link">Residents</a>
                        </li>
                        <li class="nav-item">
                            <a href="./issuedClearance.html" class="nav-link">Issued Clearance</a>
                        </li>
                        <li class="nav-item">
                            <a href="./documentRequest.html" class="nav-link">Document Requests</a>
                        </li>
                        <li class="nav-item">
                            <a href="./officials.html" class="nav-link">Officials</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
    
    `;
}