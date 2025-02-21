console.log("residentSidebar.js loaded");

document.addEventListener("DOMContentLoaded", function () {
  let residentSidebar = document.querySelector(".resident-sidebar");
  console.log("residentSidebar element:", residentSidebar);

  if (residentSidebar) {
    const logoPath = "../../assets/img/logo-125.png";
    console.log("Setting sidebar content");

    residentSidebar.innerHTML = `
      <div class="sidebar p-3 d-flex flex-column justify-content-start align-items-start" style="min-height: 100%; min-width: 300px; gap: 5px; background-color: #2D3187;">
          <div class="sidebar-brand d-flex justify-content-start align-items-center text-white">
              <img src="${logoPath}" style="width: 50px;" alt="">
              <h4>Brgy. Sinabanali</h4>
          </div>
          <div class="sidebar-nav mt-3">
              <ul class="nav flex-column">
                  <li class="nav-item">
                      <a href="./userResident.php" class="nav-link text-white">Profile</a>
                  </li>
                  <li class="nav-item">
                      <a href="./userAnnouncement.php" class="nav-link text-white">Announcement</a>
                  </li>
                  <li class="nav-item">
                      <a href="./userDocument.php" class="nav-link text-white">Document Request</a>
                  </li>
                  <li class="nav-item">
                      <a href="./blotter.php" class="nav-link text-white">Blotter Schedule</a>
                  </li>
                  <li class="nav-item d-flex justify-content-start align-items-center">
                      <a href="./residentConcerns.php" class="nav-link text-white">Concerns</a>
                  </li>
                  <li class="nav-item d-flex justify-content-start align-items-center">
                      <a href="./userNotification.php" class="nav-link text-white">Notification</a>
                      <span class="badge bg-danger text-white" id="notifCount">3</span>
                  </li>
                  <li class="nav-item">
                      <a href="../../controllers/logoutController.php" class="nav-link text-white">Logout</a>
                  </li>
              </ul>
          </div>
      </div>`;

    console.log("Sidebar content set successfully");

    const style = document.createElement("style");
    style.innerHTML = `
      .nav-link:hover {
        background-color: #1a1d5a;
      }
      .nav-link.active {
        background-color: #0d0f3a !important;
      }
    `;
    document.head.appendChild(style);

    // Set active class based on current URL
    const currentPath = window.location.pathname.split("/").pop().toLowerCase();
    console.log("Current Path:", currentPath);

    const navLinks = residentSidebar.querySelectorAll(".nav-link");

    navLinks.forEach((link) => {
      let linkPath = link.getAttribute("href").split("/").pop().toLowerCase();

      if (currentPath === linkPath) {
        navLinks.forEach((l) => l.classList.remove("active")); // Remove active class from all links
        link.classList.add("active");
        console.log(`Active class added to: ${linkPath}`);
      }
    });
  } else {
    console.error("residentSidebar element not found");
  }
});

export function notificationCount(count) {
  let notifCount = document.getElementById("notifCount");
  if (notifCount) {
    notifCount.innerHTML = count;
  }
}
