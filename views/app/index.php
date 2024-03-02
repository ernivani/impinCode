<?php include_once __DIR__ . '/../_base.php'; ?>

<body class="text-gray-800 font-inter bg-neutral-950">
    <div class="flex h-screen overflow-hidden">
        <div class="flex flex-col absolute z-40 left-0 top-0 lg:static lg:left-auto lg:top-auto lg:translate-x-0 h-screen overflow-y-scroll lg:overflow-y-auto no-scrollbar w-64 lg:w-20 lg:sidebar-expanded:!w-64 2xl:!w-64 shrink-0 bg-neutral-900 p-4 transition-all duration-200 ease-in-out -translate-x-64">
            <div class="flex justify-between mb-5 pr-3 sm:px-2">
                <button class="lg:hidden text-slate-500 hover:text-slate-400" aria-controls="sidebar" aria-expanded="false">
                    <span class="sr-only">Close sidebar</span>
                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.7 18.7l1.4-1.4L7.8 13H20v-2H7.8l4.3-4.3-1.4-1.4L4 12z"></path>
                    </svg>
                </button>
                <a aria-current="page" class="block active" href="/">
                    <img src="/svg/IMPINCODE.svg" alt="Ernicani" class="w-32 h-8 lg:w-20 lg:h-8 2xl:w-20 2xl:h-8 hover:bg-slate-800 rounded-lg transition duration-150" />
                </a>
            </div>
            <div class="space-y-8">
                <div>
                    <ul class="mt-3">
                        <li class="rounded-lg mb-3 last:mb-0 bg-slate-800 transition duration-150">
                            <a href="<?= $path('app') ?>" class=" px-4 py-4 block text-slate-200 truncate transition duration-150 hover:text-white">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <img src="/svg/learn.svg" alt="Learn" class="w-5 h-5 lg:w-4 lg:h-4 2xl:w-5 2xl:h-5" />
                                        <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Learn</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="rounded-lg mb-3 last:mb-0 hover:bg-slate-800 transition duration-150">
                        <a href="<?= $path('profile') ?>"   class=" px-4 py-4 block text-slate-200 truncate transition duration-150 hover:text-white">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <img src="/svg/profile.svg" alt="Profile" class="w-5 h-5 lg:w-4 lg:h-4 2xl:w-5 2xl:h-5" />
                                        <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Profile</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        
                        <li class="rounded-lg mb-3 last:mb-0 hover:bg-slate-800 transition duration-150">
                            <a href="<?= $path('settings') ?>"   class=" px-4 py-4 block text-slate-200 truncate transition duration-150 hover:text-white">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <img src="/svg/settings.svg" alt="Settings" class="w-5 h-5 lg:w-4 lg:h-4 2xl:w-5 2xl:h-5" />
                                        <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Settings</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden">
            
        </div>
    </div>
</body>