<div id="protocol-info">
    <div class="section-title mb-6 mt-2 border-b border-blue-800 text-blue-800">
        <h2 class="text-xl pl-4 pb-2">{{__("protocol.protocol_details")}}</h2>
    </div>
    <div class="form-section m-4">
        <div class="form-group grid grid-cols-2 gap-x-8">
            <label for="protocol_date" class="custom-label">
                {{__('protocol.protocol_date')}}
                @if(isset($mode) && ($mode === 'PREVIEW' || $mode === 'EDIT'))
                    <span class="custom-span">{{$protocol->protocol_date}}</span>
                @else
                    <input id="protocol_date" class="block mt-1 custom-input"
                                  type="date" name="protocol_date"
                                  value="{{isset($protocol) ? $protocol->protocol_date : old('protocol_date')}}">
                    @error('protocol_date') <span class="text-red-700 text-md">{{ $message }}</span> @enderror
                @endif
            </label>
        </div>
    </div>
</div>
<div id="protocol_details">
    <div class="section-title mb-4 border-b border-blue-800 text-blue-800">
        <h2 class="text-xl pl-4 pb-2">{{__('protocol.information')}}</h2>
    </div>
    <div class="form-section m-4">
        <div class="form-group grid grid-cols-2 gap-x-8">
            <label for="author" class="custom-label">
                {{__('protocol.creator')}}
                @if(isset($mode) && $mode === 'PREVIEW')
                    <span class="custom-span">{{$protocol->creator}}</span>
                @else
                    <input id="creator" class="block mt-1 custom-input" type="text"
                                  placeholder="{{__('protocol.protocol_creator')}}" name="creator"
                                  value="{{isset($protocol) ? $protocol->creator : old('creator')}}">
                    @error('creator') <span class="text-red-700 text-md">{{ $message }}</span> @enderror
                @endif
            </label>
            <label for="receiver" class="custom-label">
                {{__('protocol.receiver')}}
                @if(isset($mode) && $mode === 'PREVIEW')
                    <span class="custom-span">{{$protocol->receiver}}</span>
                @else
                    <input id="receiver" class="block mt-1 custom-input" type="text" placeholder="{{__('protocol.receiver_name')}}"
                                  name="receiver" value="{{isset($protocol) ? $protocol->receiver : old('receiver')}}">
                    @error('receiver') <span class="text-red-700 text-md">{{ $message }}</span> @enderror
                @endif
            </label>
        </div>
        <div class="form-group">
            <label for="title" class="custom-label">
                {{__('protocol.title')}}
                @if(isset($mode) && $mode === 'PREVIEW')
                    <span class="custom-span">{{$protocol->title}}</span>
                @else
                    <input id="title" class="block mt-1 custom-input" type="text" placeholder="{{__('protocol.protocol_title')}}"
                                  name="title" value="{{isset($protocol) ? $protocol->title : old('title')}}">
                    @error('title') <span class="text-red-700 text-md">{{ $message }}</span> @enderror
                @endif
            </label>
        </div>
        <div class="form-group">
            <label for="description" class="custom-label">
                {{__('protocol.description')}}
                @if(isset($mode) && $mode === 'PREVIEW')
                    <span class="custom-span">{{$protocol->description}}</span>
                @else
                    <textarea id="description" class="custom-textarea" name="description"
                              placeholder="{{__('protocol.protocol_description')}}">{{isset($protocol) ? $protocol->description : old('description')}}</textarea>
                    @error('description') <span class="text-red-700 text-md">{{ $message }}</span> @enderror
                @endif
            </label>
        </div>
    </div>
</div>

<div id="protocol_files">
    <div class="section-title mb-4 border-b border-blue-800 text-blue-800">
        <h2 class="text-xl pl-4 pb-2">{{__('protocol.documents')}}</h2>
    </div>
    <div class="form-section m-4">
        <div class="form-group">
            @if((isset($mode) && ($mode === 'PREVIEW' || $mode == 'EDIT')) && $files)
                <div class="uploaded-files mb-5">
                    @foreach($files as $file)
                        <span class="mb-5 mr-5 inline-block border-2 p-2 rounded">
                            <a href="{{route('downloadFile',['protocol'=>$protocol->id,'id'=>$file->id])}}"
                               class="download-file text-blue-700 mx-2" title="{{__('protocol.download_click')}}">
                                <i class="fas fa-download"></i>&nbsp;{{$file->name}}
                            </a>
                            @if($mode == 'EDIT')
                                <span>&#10072;</span>
                                <i class="uploaded-file custom-delete-1 fas fa-trash-alt" title="{{__('protocol.delete_click')}}"
                                   data-file="{{$file->id}}" data-protocol="{{$protocol->id}}"></i>
                            @endif
                        </span>
                    @endforeach
                </div>
            @elseif(isset($mode) && ($mode === 'PREVIEW' || $mode == 'EDIT'))
                <h2 class="mb-5">{{__('protocol.files_no_found')}}</h2>
            @endif
            @if(isset($mode) && $mode == 'EDIT')
                <label for="file" class="custom-label">
                    {{__('protocol.select_file')}}
                    <div class="flex">
                        <input type="file" name="file[]" placeholder="{{__('protocol.select_file')}}" class="block mt-1">
                    </div>
                    @error('file[]') <span class="text-red-700 text-md">{{ $message }}</span> @enderror
                </label>
            @endif
        </div>
        @if(isset($mode) && $mode !== 'PREVIEW')
            <div>
                <a id="addFileButton" type="button" class="add-files-button">{{__('protocol.add_file')}}</a>
            </div>
        @endif
    </div>
</div>
