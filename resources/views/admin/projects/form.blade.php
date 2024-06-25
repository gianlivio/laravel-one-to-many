<form action="{{ isset($project->id) ? route('admin.projects.update', $project->id) : route('admin.projects.store') }}" method="POST">
    @csrf
    @if(isset($project->id))
        @method('PUT')
    @endif

    <div class="form-group">
        <label for="name">Nome:</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $project->name ?? '') }}">
    </div>

    <div class="form-group">
        <label for="description">Descrizione:</label>
        <textarea class="form-control" id="description" name="description">{{ old('description', $project->description ?? '') }}"></textarea>
    </div>

    <div class="form-group">
        <label for="type_id">Tipologia:</label>
        <select class="form-control" id="type_id" name="type_id">
            <option value="">Seleziona una tipologia</option>
            @foreach($types as $type)
                <option value="{{ $type->id }}" {{ (old('type_id') ?? $project->type_id ?? '') == $type->id ? 'selected' : '' }}>
                    {{ $type->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Salva</button>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Indietro</a>
    </div>
</form>