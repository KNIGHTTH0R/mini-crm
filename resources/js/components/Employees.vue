<template>
    <div>
        <h1>Employees</h1>

        <router-link class="waves-effect waves-light btn" to="/add-employer">new employer</router-link>

        <table id="example" class="display" style="width:100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Company</th>
                <th>Action</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Company</th>
                <th>Action</th>
            </tr>
            </tfoot>
        </table>

    </div>
</template>

<script>
    export default {
        name: "Employees.vue",
        mounted: function () {
            self = this;
            $(document).ready(function () {

                $('#example').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: 'api/employee',
                        headers: {'Authorization': self.$store.state.token}
                    },
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'first_name', name: 'first_name'},
                        {data: 'last_name', name: 'last_name'},
                        {data: 'email', name: 'email'},
                        {data: 'phone', name: 'phone'},
                        {data: 'company_id', name: 'company_id'},
                        {data: 'id', name: 'action'}
                    ],
                    "columnDefs": [
                        {
                            "targets": 6,
                            "data": "id",
                            "render": function (id) {
                                return '' +
                                    '<a class="btn-floating waves-light green" href="/#/employer/'+id+'"><i class="material-icons">create</i></a>' +
                                    '<a class="btn-floating waves-light red" href="/#/remove-employer/'+id+'"><i class="material-icons">delete</i></a>';
                            }
                        },
                    ]
                });
            });
        },
    }

</script>

<style scoped>

</style>
