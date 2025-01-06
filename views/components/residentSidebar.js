console.log("residentSidebar.js loaded");

let residentSidebar = document.querySelector(".resident-sidebar");
console.log("residentSidebar element:", residentSidebar);

if (residentSidebar) {
    const logoPath = "../../assets/img/logo-125.png";
    console.log("Setting sidebar content");

    residentSidebar.innerHTML = `
    <div class="sidebar p-3 d-flex flex-column justify-content-start align-items-start" style="min-height: 100%; min-width: 300px; gap: 5px; background-color: #2D3187;">
        <div class="sidebar-brand d-flex justify-content-start align-items-center text-white">
            <img src="${logoPath}" style="width: 70px;" alt="">
            <h2>Brgy. Sinabanali</h2>
        </div>
        <div class="sidebar-nav mt-3">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="" class="nav-link text-white">Profile</a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link text-white">Announcement</a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link text-white">Document Request</a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link text-white">Notification</a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link text-white">Logout</a>
                </li>
            </ul>
        </div>
    </div>`;
    console.log("Sidebar content set successfully");
} else {
    console.error("residentSidebar element not found");
}

