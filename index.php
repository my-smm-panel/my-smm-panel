<!DOCTYPE html>  
<html lang="en">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">  
    <title>DG SERVICE - Ultimate Panel</title>  
    <script src="https://cdn.tailwindcss.com"></script>  
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">  
    <style>  
        html, body { height: 100%; overscroll-behavior: none; background-color: #020617; color: white; font-family: 'Inter', sans-serif; }  
        .glass { background: rgba(15, 23, 42, 0.9); backdrop-filter: blur(10px); border-radius: 20px; border: 1px solid rgba(255,255,255,0.1); }  
        .neo-input { background: #0a0f1d; border: 1px solid #1e293b; color: white; border-radius: 12px; padding: 12px; font-size: 13px; }  
        #sidebar { transition: 0.3s cubic-bezier(0.4, 0, 0.2, 1); transform: translateX(-100%); z-index: 1000; }  
        #sidebar.open { transform: translateX(0); }  
        .sidebar-item { padding: 14px 20px; display: flex; align-items: center; gap: 12px; font-size: 13px; font-weight: 600; color: #94a3b8; border-bottom: 1px solid rgba(255,255,255,0.03); cursor: pointer; }
    </style>  
</head>  
<body>  

<div id="sidebarOverlay" onclick="toggleSidebar()" class="hidden fixed inset-0 bg-black/70 z-[900] backdrop-blur-sm"></div>  
<div id="sidebar" class="fixed top-0 left-0 h-full w-64 bg-[#0a0f1d] border-r border-white/5 shadow-2xl overflow-y-auto">  
    <div class="p-6 border-b border-white/5 flex items-center gap-3">  
        <img id="sideImg" class="w-12 h-12 rounded-full border-2 border-blue-500 shadow-lg" src="">  
        <div>  
            <p id="sideName" class="text-sm font-black truncate w-32">User Name</p>  
            <p class="text-[9px] text-blue-500 uppercase font-bold tracking-widest">Premium Member</p>  
        </div>  
    </div>  
    <div class="flex flex-col py-2">  
        <div onclick="switchTab('home')" class="sidebar-item"><i class="fas fa-shopping-cart text-blue-400"></i> New Order</div>  
        <div onclick="switchTab('history')" class="sidebar-item"><i class="fas fa-list text-purple-400"></i> My Orders</div>  
        <div onclick="openAddMoney()" class="sidebar-item"><i class="fas fa-wallet text-green-400"></i> Deposit Funds</div>  
        
        <p class="px-5 text-[9px] font-black text-gray-500 uppercase mt-4 mb-2">Support Center</p>
        <div onclick="window.open('https://wa.me/917775975170')" class="sidebar-item"><i class="fab fa-whatsapp text-green-500"></i> WhatsApp Help</div>
        <div onclick="window.open('https://telegram.me/Digisellprobot')" class="sidebar-item"><i class="fab fa-telegram text-blue-400"></i> Telegram Bot</div>
        <div onclick="window.open('https://www.instagram.com/dg.service.1?igsh=NXR0bWQ1N24zcGxq')" class="sidebar-item"><i class="fab fa-instagram text-pink-500"></i> Instagram Support</div>

        <div id="adminSidebar" class="hidden mt-4 pt-4 border-t border-red-500/20">  
            <p class="px-5 text-[9px] font-black text-red-500 uppercase mb-2">Master Admin Panel</p>  
            <div onclick="switchTab('admin-users')" class="sidebar-item text-red-400"><i class="fas fa-users"></i> User Management</div>  
            <div onclick="switchTab('admin-orders')" class="sidebar-item text-red-400"><i class="fas fa-box-open"></i> Order Controls</div>  
            <div onclick="switchTab('admin-services')" class="sidebar-item text-red-400"><i class="fas fa-cogs"></i> Service Settings</div>  
        </div>  
        <div onclick="logoutUser()" class="sidebar-item text-red-500 mt-10"><i class="fas fa-sign-out-alt"></i> Logout</div>  
    </div>  
</div>

<div id="appScreen" class="h-full flex flex-col">
    <div class="bg-slate-900/80 p-4 flex justify-between items-center border-b border-white/5 sticky top-0 z-50 backdrop-blur-md">
        <button onclick="toggleSidebar()" class="text-white text-xl"><i class="fas fa-bars"></i></button>
        <h1 class="font-black italic text-blue-500 uppercase">DG SERVICE</h1>
        <div class="bg-blue-600/10 px-4 py-1 rounded-full border border-blue-500/20 text-green-400 font-bold" id="headerBalance">₹0.00</div>
    </div>

    <div id="mainContainer" class="p-4 pb-24 overflow-y-auto">
        <div id="homeTab" class="tab-content glass p-6 space-y-4">
            <h3 class="text-xs font-black text-blue-500 uppercase tracking-widest">Create New Order</h3>
            <select id="catSelect" class="w-full neo-input outline-none"><option>Loading Categories...</option></select>
            <select id="serviceSelect" class="w-full neo-input outline-none"><option>Select Service</option></select>
            <input type="text" id="link" placeholder="Order Link" class="w-full neo-input outline-none">
            <input type="number" id="qty" placeholder="Quantity" class="w-full neo-input outline-none">
            <button onclick="placeOrder()" class="w-full bg-blue-600 py-4 rounded-xl font-black uppercase shadow-lg shadow-blue-500/30">Submit Order</button>
        </div>

        <div id="admin-usersTab" class="tab-content hidden glass p-5 space-y-4">
            <h3 class="text-red-500 font-black text-xs uppercase text-center">User Management</h3>
            <div class="p-3 bg-white/5 rounded-xl border border-red-500/20">
                <input id="targetUID" type="text" placeholder="Target User UID" class="w-full neo-input mb-2">
                <div class="flex gap-2">
                    <input id="injectAmt" type="number" placeholder="Amt" class="w-full neo-input">
                    <button onclick="adminAction('balance')" class="bg-green-600 px-4 rounded-lg font-bold text-[10px]">ADD</button>
                    <button onclick="adminAction('block')" class="bg-red-600 px-4 rounded-lg font-bold text-[10px]">BLOCK</button>
                </div>
            </div>
            <div id="userDatabase" class="space-y-2 max-h-96 overflow-y-auto"></div>
        </div>

        <div id="admin-ordersTab" class="tab-content hidden glass p-5">
            <h3 class="text-red-500 font-black text-xs uppercase mb-4 text-center">Live Order Control</h3>
            <div id="allOrdersList" class="space-y-3"></div>
        </div>
    </div>
</div>

<script type="module">
    import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";
    import { getAuth, GoogleAuthProvider, onAuthStateChanged, signInWithPopup, signOut } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-auth.js";
    import { getDatabase, ref, onValue, set, update, increment } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-database.js";

    const firebaseConfig = {
      apiKey: "AIzaSyCbOQZjrqbfr6r23MFNlDZavyB9AChK_XM",
      authDomain: "smspanel-76488.firebaseapp.com",
      databaseURL: "https://smspanel-76488-default-rtdb.firebaseio.com",
      projectId: "smspanel-76488",
      appId: "1:478520093402:web:bf976787e36af3017b13e3"
    };

    const app = initializeApp(firebaseConfig);
    const auth = getAuth(app);
    const db = getDatabase(app);
    const provider = new GoogleAuthProvider();
    
    const BACKEND = "https://dg-backend-jhqa.onrender.com"; //
    const ADMIN_UID = "cmEr126Ej8YuXZuPV4Pm88tR9Il2"; //

    onAuthStateChanged(auth, (user) => {
        if (user) {
            document.getElementById('sideName').innerText = user.displayName || user.email.split('@')[0];
            document.getElementById('sideImg').src = user.photoURL || "https://ui-avatars.com/api/?name=User";
            
            // Activate Master Admin Features
            if(user.uid === ADMIN_UID) {
                document.getElementById('adminSidebar').classList.remove('hidden');
                loadAdminData();
            }

            onValue(ref(db, 'users/' + user.uid + '/balance'), (s) => {
                document.getElementById('headerBalance').innerText = "₹" + (s.val() || 0).toFixed(2);
            });
        }
    });

    // Master Admin Logic: User List & UID Copy
    function loadAdminData() {
        onValue(ref(db, 'users'), (snap) => {
            const list = document.getElementById('userDatabase');
            list.innerHTML = "";
            snap.forEach(child => {
                const u = child.val();
                list.innerHTML += `<div onclick="navigator.clipboard.writeText('${child.key}'); alert('UID Copied')" class="flex justify-between p-3 bg-white/5 rounded-xl text-[10px] font-bold border-b border-white/5 cursor-pointer">
                    <span>${u.email}</span><span class="text-green-400">₹${(u.balance || 0).toFixed(2)}</span>
                </div>`;
            });
        });
    }

    // Master Admin Logic: Block/Balance
    window.adminAction = async (type) => {
        const uid = document.getElementById('targetUID').value;
        if(!uid) return alert("UID required");
        if(type === 'balance') {
            const amt = parseFloat(document.getElementById('injectAmt').value);
            await update(ref(db, `users/${uid}`), { balance: increment(amt) });
            alert("Balance Updated");
        } else if(type === 'block') {
            await update(ref(db, `users/${uid}`), { status: 'Blocked' });
            alert("User Blocked");
        }
    };

    window.toggleSidebar = () => { document.getElementById('sidebar').classList.toggle('open'); document.getElementById('sidebarOverlay').classList.toggle('hidden'); };
    window.switchTab = (t) => { 
        document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden')); 
        document.getElementById(t + 'Tab').classList.remove('hidden'); 
        toggleSidebar(); 
    };
    window.logoutUser = () => signOut(auth).then(() => location.reload());
</script>
</body>
</html>
