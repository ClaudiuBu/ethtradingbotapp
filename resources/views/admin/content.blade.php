<div class="container flex gap-2">
<!--  Menu left -->
<ul class="w-1/10">
    <li>
        <a href="{{ route('admin') }}">Dashboard</a>
    </li>
    <li>
        <a href="{{ route('configuration') }}">Configurations</a>
    </li>
</ul>

<!-- Content right -->
<div class="content w-9/10">
    <div class="content-header">
        <h1>Dashboard</h1>
    </div>
    <div class="content-body">
        <div class="content-body-item">
            <h2>Configurations</h2>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Value</th>
                        <th>Description</th>
                        <th>Type</th>
                        <th>Group</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($configurations as $configuration)
                    <tr>
                        <td>{{ $configuration->name }}</td>
                        <td>{{ $configuration->value }}</td>
                        <td>{{ $configuration->description }}</td>
                        <td>{{ $configuration->type }}</td>
                        <td>{{ $configuration->group }}</td>
                        <td>
                            <a href="">Edit</a>
                            <a href="">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
