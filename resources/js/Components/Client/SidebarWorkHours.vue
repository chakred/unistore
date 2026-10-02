<template>
    <div>
        <div class="card">
            <div class="card-header">
                <span>{{ $t('sidebar.workHours.title') }}</span>
            </div>
            <div class="card-body">
                <i class="far fa-calendar-alt"></i>
                <span>{{ $t('sidebar.workHours.days') }}</span>
                <hr/>
                <i class="far fa-clock"></i>
                <span>{{ $t('sidebar.workHours.hours') }}</span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    /**
     * Name.
     */
    name: 'SidebarWorkHours',
}
</script>
