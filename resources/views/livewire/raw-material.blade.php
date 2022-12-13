<div>
    <div class="row mb-3">
        <label for="name" class="col-sm-2 col-form-label required">BOM *</label>
        <div class="col-sm-10"> 
            <input type="text" class="form-control" name="bom_id" value="{{$bom_number}}" readonly>   
            @error('bom_id')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>
    <div class="row mb-3">
        <label for="name" class="col-sm-2 col-form-label required">Type *</label>
        <div class="col-sm-10">          
                <select wire:model="type" name="type_id" class="form-control" required>
                    <option value="">Choose Type</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>            
                @error('type_id')
                <span class="text-danger">{{$message}}</span>
                @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="name" class="col-sm-2 col-form-label required">Material *</label>
        <div class="col-sm-10">          
                <select wire:model="raw_material" name="raw_material_id" class="form-control" required>
                    @if($raw_materials->count()==0)
                    <option value="">Choose Type First</option>
                    @else
                    <option value="">Choose Material</option>
                    @endif
                    @foreach ($raw_materials as $raw_material)
                        <option value="{{ $raw_material->id }}">{{ $raw_material->name }}-{{$raw_material->part_description}}</option>
                    @endforeach
                </select>
                @error('raw_material_id')
                <span class="text-danger">{{$message}}</span>
                @enderror
        </div>
        
    </div>
    <div class="row mb-3">
        <label for="name" class="col-sm-2 col-form-label required">Nesting *</label>
        <div class="col-sm-10">          
                <select id="nesting_id" name="nesting_id" class="form-control" required>
                    <option value="">Choose Nesting</option>
                    @foreach ($nestings as $nesting)
                        <option value="{{ $nesting->id }}">{{ $nesting->name }} </option>
                    @endforeach
                </select>            
            @error('nesting_id')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>
    </div>