<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4895ef;
            --light-bg: #f8f9fa;
            --card-bg: #ffffff;
            --text-color: #2c3e50;
            --text-muted: #6c757d;
        }

        body {
            background-color: var(--light-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-color);
        }

        .dashboard-card {
            background: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
            border: none;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .welcome-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 2rem;
            text-align: center;
            margin-bottom: 2rem;
        }

        .welcome-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .welcome-subtitle {
            font-size: 1.25rem;
            opacity: 0.9;
            margin-bottom: 0;
        }

        .stats-card {
            padding: 1.5rem;
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .stats-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .stats-number {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stats-label {
            color: var(--text-muted);
            font-size: 1rem;
        }

        .quick-actions {
            padding: 1.5rem;
        }

        .action-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            background: var(--light-bg);
            border-radius: 8px;
            color: var(--text-color);
            text-decoration: none;
            transition: all 0.3s ease;
            margin-bottom: 1rem;
        }

        .action-btn:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-3px);
        }

        .action-icon {
            font-size: 1.5rem;
            margin-right: 1rem;
        }

        @media (max-width: 768px) {
            .welcome-title {
                font-size: 2rem;
            }
            .welcome-subtitle {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    @include('navbar')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="welcome-header">
                    <h1 class="welcome-title">Bienvenido de vuelta</h1>
                    <p class="welcome-subtitle">Aquí tienes un resumen de tu actividad reciente</p>
                </div>
            </div>
        </div>

        <div class="container mt-4">
            <div class="row">
                <!-- Estadísticas rápidas -->
                <div class="col-md-4">
                    <div class="dashboard-card stats-card">
                        <div class="stats-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stats-number">2</div>
                        <div class="stats-label">Usuarios registrados</div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="dashboard-card stats-card">
                        <div class="stats-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="stats-number">78%</div>
                        <div class="stats-label">Crecimiento mensual</div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="dashboard-card stats-card">
                        <div class="stats-icon">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <div class="stats-number">24</div>
                        <div class="stats-label">Tareas pendientes</div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-8">
                    <div class="dashboard-card" style="padding: 2rem;">
                        <h3 class="mb-4"><i class="fas fa-chart-bar text-primary me-2"></i> Actividad reciente</h3>
                        <div class="text-center py-5">
                            <i class="fas fa-chart-pie text-muted" style="font-size: 5rem; opacity: 0.3;"></i>
                            <p class="mt-3 text-muted">Gráficos de actividad aparecerán aquí</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="dashboard-card quick-actions">
                        <h3 class="mb-4"><i class="fas fa-bolt text-primary me-2"></i> Acciones rápidas</h3>
                        <a href="#" class="action-btn">
                            <i class="fas fa-plus action-icon"></i>
                            <span>Nuevo proyecto</span>
                        </a>
                        <a href="#" class="action-btn">
                            <i class="fas fa-file-import action-icon"></i>
                            <span>Importar datos</span>
                        </a>
                        <a href="#" class="action-btn">
                            <i class="fas fa-cog action-icon"></i>
                            <span>Configuración</span>
                        </a>
                        <a href="#" class="action-btn">
                            <i class="fas fa-bell action-icon"></i>
                            <span>Notificaciones</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <script>
            Swal.fire({
                title: "¡Éxito!",
                text: "{{ session('success') }}",
                icon: "success",
                timer: 3000,
                showConfirmButton: false,
                background: 'var(--card-bg)',
                color: 'var(--text-color)'
            });
        </script>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>