            <div class="sidebar">
                <nav class="sidebar-nav">
                    <ul class="nav">
                        <li @click="menu=0" class="nav-item">
                            <a class="nav-link active" href="#"><i class="icon-speedometer"></i> Escritorio</a>
                        </li>
                        <li class="nav-title">
                            Mantenimiento
                        </li>

                        <li class="nav-item nav-dropdown">
                            <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-people"></i> Integrantes</a>
                            <ul class="nav-dropdown-items">
                                <li @click="menu=5"  class="nav-item">
                                    <a class="nav-link" href="#"><i class="icon-user"></i> Delegados</a>
                                </li>
                            </ul>
                        </li>
                        
                    </ul>
                </nav>
                <button class="sidebar-minimizer brand-minimizer" type="button"></button>
            </div>