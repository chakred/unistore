<template>
    <Head title="Dashboard" />
    <Nav />
    <div class="container mt-10">
        <div class="row gx-4 gy-4 dashboard-stats">
            <div class="col-md-4">
                <div class="dashboard-stat-card">
                    <div class="dashboard-stat-card__icon">
                        <i class="fa-solid fa-boxes-packing"></i>
                    </div>
                    <div>
                        <div class="dashboard-stat-card__value">{{ stats.totalGoods }}</div>
                        <div class="dashboard-stat-card__label">Total goods</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="dashboard-stat-card dashboard-stat-card--info">
                    <div class="dashboard-stat-card__icon">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    <div>
                        <div class="dashboard-stat-card__value">{{ stats.totalOrders }}</div>
                        <div class="dashboard-stat-card__label">Total orders</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="dashboard-stat-card dashboard-stat-card--success">
                    <div class="dashboard-stat-card__icon">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                    <div>
                        <div class="dashboard-stat-card__value">{{ stats.soldGoods }}</div>
                        <div class="dashboard-stat-card__label">Goods sold</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="dashboard-stat-card dashboard-stat-card--danger">
                    <div class="dashboard-stat-card__icon">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>
                    <div>
                        <div class="dashboard-stat-card__value">{{ stats.outOfStock }}</div>
                        <div class="dashboard-stat-card__label">Out of stock</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="dashboard-stat-card dashboard-stat-card--warning">
                    <div class="dashboard-stat-card__icon">
                        <i class="fa-solid fa-cubes-stacked"></i>
                    </div>
                    <div>
                        <div class="dashboard-stat-card__value">{{ stats.lowStock }}</div>
                        <div class="dashboard-stat-card__label">Low stock</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="dashboard-panel">
                    <h5 class="dashboard-panel__title">Top viewed goods</h5>
                    <table v-if="topViewedGoods.length" class="table">
                        <thead>
                        <tr>
                            <th scope="col">Good</th>
                            <th scope="col">Views</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="good in topViewedGoods" :key="good.id">
                            <td>{{ good.name }}</td>
                            <td>{{ good.views }}</td>
                        </tr>
                        </tbody>
                    </table>
                    <p v-else class="text-muted mb-0">No views tracked yet.</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Head } from '@inertiajs/vue3';
import Nav from '@/Components/Admin/Nav.vue';

export default {
    /**
     * Name.
     */
    name: 'Dashboard',

    components: {
        Head,
        Nav
    },

    /**
     * Props.
     */
    props: {
        stats: {
            type: Object,
            default: () => ({
                totalGoods: 0,
                outOfStock: 0,
                lowStock: 0,
                totalOrders: 0,
                soldGoods: 0,
            }),
        },
        topViewedGoods: {
            type: Array,
            default: () => [],
        },
    },
}
</script>

<style scoped>
.dashboard-stat-card {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.25rem;
    border-radius: 8px;
    background: #fff;
    box-shadow: 0 1px 3px rgba(0, 0, 0, .08);
}

.dashboard-stat-card__icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 3rem;
    height: 3rem;
    border-radius: 50%;
    background: #f1f1f1;
    font-size: 1.25rem;
    color: #212529;
    flex-shrink: 0;
}

.dashboard-stat-card--danger .dashboard-stat-card__icon {
    background: #f8d7da;
    color: #dc3545;
}

.dashboard-stat-card--warning .dashboard-stat-card__icon {
    background: #fff3cd;
    color: #c99a1b;
}

.dashboard-stat-card--info .dashboard-stat-card__icon {
    background: #cfe2ff;
    color: #0d6efd;
}

.dashboard-stat-card--success .dashboard-stat-card__icon {
    background: #d1e7dd;
    color: #198754;
}

.dashboard-stat-card__value {
    font-size: 1.6rem;
    font-weight: 700;
    line-height: 1.2;
}

.dashboard-stat-card__label {
    font-size: .85rem;
    color: #6c757d;
}

.dashboard-panel {
    padding: 1.25rem;
    border-radius: 8px;
    background: #fff;
    box-shadow: 0 1px 3px rgba(0, 0, 0, .08);
}

.dashboard-panel__title {
    margin-bottom: 1rem;
}
</style>
