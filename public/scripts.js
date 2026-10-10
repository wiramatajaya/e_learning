        function showAlert(type, message) {
            const container = document.getElementById('alert-container');
            // Konfigurasi warna berdasarkan tipe alert
            let bgClass, borderClass, textClass, icon;
            switch (type) {
                case 'success':
                    bgClass = 'bg-emerald-50';
                    borderClass = 'border-emerald-500';
                    textClass = 'text-emerald-800';
                    icon = '✓';
                    break;
                case 'error':
                    bgClass = 'bg-rose-50';
                    borderClass = 'border-rose-500';
                    textClass = 'text-rose-800';
                    icon = '✕';
                    break;
                case 'warning':
                    bgClass = 'bg-amber-50';
                    borderClass = 'border-amber-500';
                    textClass = 'text-amber-800';
                    icon = '⚠';
                    break;
                default: // info
                    bgClass = 'bg-blue-50';
                    borderClass = 'border-blue-500';
                    textClass = 'text-blue-800';
                    icon = 'ℹ';
            }

            // Membuat elemen alert baru
            const alertBox = document.createElement('div');
            alertBox.className = `pointer-events-auto flex items-center p-4 min-w-[300px] max-w-md rounded-lg border-l-4 shadow-lg transition-all duration-300 ease-in-out transform translate-x-full opacity-0 ${bgClass} ${borderClass} ${textClass}`;
            
            // Isi HTML di dalam alert
            alertBox.innerHTML = `
                <div class="flex-shrink-0 font-bold mr-3">${icon}</div>
                <div class="flex-1 text-sm font-medium mr-8">${message}</div>
                <button class="absolute top-4 right-4 text-gray-400 hover:text-gray-900 text-xs focus:outline-none" onclick="closeAlert(this.parentElement)">
                    ✕
                </button>
            `;

            // Tambahkan ke container
            container.appendChild(alertBox);

            // Trigger animasi masuk (slide in) setelah sedikit delay
            setTimeout(() => {
                alertBox.classList.remove('translate-x-full', 'opacity-0');
            }, 10);

            // Otomatis tutup setelah 4 detik
            setTimeout(() => {
                closeAlert(alertBox);
            }, 4000);
        }

        function closeAlert(element) {
            if (!element) return;
            // Animasi keluar (slide out & fade out)
            element.classList.add('translate-x-full', 'opacity-0');
            // Hapus elemen dari DOM setelah animasi selesai (300ms)
            setTimeout(() => {
                element.remove();
            }, 300);
        }