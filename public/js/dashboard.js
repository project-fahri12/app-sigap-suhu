 document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu toggle
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const sidebar = document.getElementById('sidebar');
            
            mobileMenuBtn.addEventListener('click', function() {
                sidebar.classList.toggle('active');
            });
            
            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                const isClickInsideSidebar = sidebar.contains(event.target);
                const isClickOnMobileMenuBtn = mobileMenuBtn.contains(event.target);
                const isMobile = window.innerWidth <= 1024;
                
                if (isMobile && !isClickInsideSidebar && !isClickOnMobileMenuBtn && sidebar.classList.contains('active')) {
                    sidebar.classList.remove('active');
                }
            });
            
            // Chart period buttons
            const chartBtns = document.querySelectorAll('.chart-btn');
            chartBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    chartBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                });
            });
            
            // User profile dropdown simulation
            const userProfile = document.getElementById('user-profile');
            userProfile.addEventListener('click', function() {
                alert('User profile menu would open here');
            });
            
            // Table row click
            const tableRows = document.querySelectorAll('tbody tr');
            tableRows.forEach(row => {
                row.addEventListener('click', function(e) {
                    if (!e.target.closest('button')) {
                        const orderId = this.cells[0].textContent;
                        alert(`Viewing details for order ${orderId}`);
                    }
                });
            });
            
            // Quick action buttons
            const quickActionBtns = document.querySelectorAll('.btn');
            quickActionBtns.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    if (this.textContent.includes('Add New Product')) {
                        alert('Add New Product form would open');
                    } else if (this.textContent.includes('Invite User')) {
                        alert('Invite User modal would open');
                    } else if (this.textContent.includes('Generate Report')) {
                        alert('Report generation started...');
                    } else if (this.textContent.includes('System Settings')) {
                        alert('Redirecting to system settings');
                    }
                });
            });
            
            // Update current time in footer every minute
            function updateFooterTime() {
                const now = new Date();
                const options = { 
                    weekday: 'long', 
                    hour: '2-digit', 
                    minute: '2-digit',
                    hour12: false
                };
                const timeString = now.toLocaleTimeString('en-US', options);
                
                const footer = document.querySelector('.footer p');
                if (footer) {
                    footer.innerHTML = footer.innerHTML.replace(/Last updated:.*?(\|)/, `Last updated: ${timeString} $1`);
                }
            }
            
            // Update time initially and every minute
            updateFooterTime();
            setInterval(updateFooterTime, 60000);
        });