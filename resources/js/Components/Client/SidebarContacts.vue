<template>
    <div>
        <div class="card">
            <div class="card-header">
                <span>{{ $t('sidebar.contacts.title') }}</span>
            </div>
            <div class="card-body">
                <i class="fas fa-map-marker-alt"></i>
                <span>АвтоКонтинент ТК</span>
                <hr>
                <i class="fas fa-phone-volume"></i>
                <a href="tel:+380936243391">+380936243391</a>
                <hr>
                <i class="fa fa-question-circle"></i>
                <span>{{ $t('sidebar.contacts.support') }}</span>
                <hr>
                <i class="fas fa-phone-volume"></i>
                <a href="tel:+380630658100">+380630658100</a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    /**
     * Name.
     */
    name: 'SidebarContacts',
}
</script>


