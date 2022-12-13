<div>
    <div class="row mb-3">
        <label for="name" class="col-sm-2 col-form-label required">Route Card *</label>
        <div class="col-sm-8"> 
            <input type="text" class="form-control" name="route_card_number" value="{{$route_card_number}}" readonly>   
        </div>
    </div>
    <div class="row mb-3">
        <label for="name" class="col-sm-2 col-form-label required">Category*</label>
        <div class="col-sm-8">
            <select wire:model='category' name="category_id" id="category_id" class="form-control select2">
                <option value="1" selected>RM</option>
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <label for="name" class="col-sm-2 col-form-label required">Type*</label>
        <div class="col-sm-8">
            <select wire:model='type' name="type_id" id="type_id" class="form-control select2">
                <option value="" >Select Type</option>
                @foreach ($types as $type)
                <option value="{{$type->id}}">{{$type->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <label for="name" class="col-sm-2 col-form-label required">Part Description*</label>
        <div class="col-sm-8">
            <select wire:model='raw_material' name="raw_material_id" id="raw_material_id" class="form-control select2">
                @if($raw_materials->count()==0)
                <option value="">Select Type First</option>
                @else
                <option value="">Select Material</option>
                @foreach ($raw_materials as $raw_material)
                    <option value="{{$raw_material->id}}" >{{$raw_material->name}}-{{$raw_material->part_description}}</option>
                @endforeach
                @endif
            </select>
            @error('raw_material_id')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>

    
    <div class="row mb-3">
        <label for="name" class="col-sm-2 col-form-label required">Nesting*</label>
        <div class="col-sm-8">
            <select wire:model='nesting' name="nesting_id" id="nesting_id" class="form-control">
                @if($nestings->count()==0)
                <option value="">Select Type First</option>
                @else
                <option value="">Select Nesting</option>
                    @foreach ($nestings as $nesting)
                    <option value="{{$nesting->id}}">{{$nesting->nesting->name}}</option>
                    @endforeach
                @endif
            </select>
        </div>
        
    </div> 
    
    
    <div class="row mb-3">
        <label for="name" class="col-sm-2 col-form-label required">Available Quantity*</label>
        <div class="col-sm-8">
            <input type="text" name="available_quantity" id="available_quantity" wire:model="stock" value="{{$stock}}" class="form-control">
            @error('available_quantity')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        
    </div> 

    <div class="row mb-3">
        <label for="name" class="col-sm-2 col-form-label required">Uom*</label>
        <div class="col-sm-8">
            <select  name="uom_id" id="uom_id" class="form-control select2">
                @if($uoms->count()==0)
                <option value="">Select Raw Material First..</option>
                @else
                <option value="">Select Uom</option>
                @foreach ($uoms as $uom)
                    <option value="{{$uom->id}}" @if($uom_id==$uom->id) selected @endif {{ old('uom_id') == $uom->id ? "selected" : "" }} >{{$uom->name}}</option>
                @endforeach
                @endif
            </select>
          @error('uom_id')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="issue_quantity" class="col-sm-2 col-form-label required">Issue Quantity*</label>
        <div class="col-sm-8">
            <input type="text"  name="issue_quantity" id="issue_quantity" value="0" class="form-control">
            @error('issue_quantity')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>
    
</div>
