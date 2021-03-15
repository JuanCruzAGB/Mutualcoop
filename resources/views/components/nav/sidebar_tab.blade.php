<section id="tab" class="sidebar left closed push-body">
    <div class="sidebar-header">
        <div class="sidebar-title logo">
            <!-- <img src="/img/recursos/logo.png" alt="Mututalcoops"> -->
            <h2>Tab Menu</h2>
        </div>
        <a href="#" class="sidebar-button close-btn left">
            <i class="sidebar-icon fas fa-times"></i>
        </a>
    </div>

    <div class="sidebar-content">
        @component('components.tab.global', [
            'tabs' => $tabs,    
        ])
        @endcomponent
    </div>
</section>