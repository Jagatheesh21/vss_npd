    <div>

    <div class="row mb-3">
        <label for="name" class="col-sm-2 col-form-label required">Category *</label>
        <div class="col-sm-10">
                     
                <select wire:model="category" id="category_id" name="category_id" class="form-control" required>
                    <option value="">Choose Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>            
        </div>
    </div>
    <div class="row mb-3">
        <label for="name" class="col-sm-2 col-form-label required">Type *</label>
        <div class="col-sm-10">  
                <select wire:model="type" name="type_id" class="form-control" required>
                    @if($types->count()==0)
                    <option value="">Choose Category First</option>
                    @else
                    <option value="">Choose Type</option>
                    @endif
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
        </div>
        
    </div>
    <div class="row mb-3" wire:ignore>
        <label for="name" class="col-sm-2 col-form-label required">ChildParts *</label>
        <div class="col-sm-10"> 
                <select name="child_part_id"  id="child_part_id" class="form-control select2" required>
                    <option value="">Choose Child Part</option>
                    @foreach ($child_parts as $child_part)
                        <option value="{{ $child_part->id }}">{{ $child_part->name }}</option>
                    @endforeach
                </select>
            </div>
    </div>
    <div class="row mb-3">
        <label for="name" class="col-sm-2 col-form-label required">UOM *</label>
        <div class="col-sm-10">          
                <select wire:model="uom" name="uom_id" class="form-control select2" required>
                    <option value="">Choose UOM</option>
                    @foreach ($uoms as $uom)
                        <option value="{{ $uom->id }}">{{ $uom->name }}</option>
                    @endforeach
                </select>
        </div>
    </div>

    </div>
    @push('scripts')
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script>
    $(document).ready(function() {
        $('#child_part_id').select2();
        $('#category_id').select2();
        $('#type_id').select2();
        $('#uom_id').select2();
        $('#category_id').on('change', function (e) {
            var data = $('#category_id').select2("val");
            @this.set('category', data);
        });
        $('#type_id').on('change', function (e) {
            var data = $('#type_id').select2("val");
            @this.set('type', data);
        });
        $('#child_part_id').on('change', function (e) {
            var data = $('#child_part_id').select2("val");
            @this.set('child_part', data);
        });
    });
    </script>
    @endpush