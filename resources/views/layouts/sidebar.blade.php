<div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
    <div class="nano">
        <div class="nano-content">
            <div class="logo"><a href="/"><span>Focus</span></a></div>
            <ul>
                
                
                <li class="{{ (request()->is('category/*')) ? 'active' : '' }}"><a href="{{ route('category.index') }}"><i class="ti-view-list-alt"></i> Category </a></li>
                <li class="{{ (request()->is('product/*')) ? 'active' : '' }}"><a href="{{ route('product.index') }}"><i class="ti-view-list-alt"></i> Product</a></li>
                
            </ul>
        </div>
    </div>
</div>
<!-- /# sidebar -->