@extends('layouts.admin')

@section('content')
<div class="container-fluid py-6">
  <div class="row">
    <div class="card">
      <ul class="d-flex justify-content-around nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item w-50" role="presentation">
          <button class="nav-link active w-100 m-auto" id="catlist-tab" data-bs-toggle="tab" data-bs-target="#catlist" type="button" role="tab" aria-controls="catlist" aria-selected="true"> Product List</button>
        </li>
        <li class="nav-item w-50" role="presentation">
          <button class="nav-link w-100 m-auto" id="cat-tab" data-bs-toggle="tab" data-bs-target="#cat" type="button" role="tab" aria-controls="cat" aria-selected="false">Add Product</button>
        </li>
      </ul>

      <div class="card-body">
       <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="catlist" role="tabpanel" aria-labelledby="catlist-tab">
          <table id="catlist" class="table table-striped" style="width:100%">
             <thead class="thead-light">
               <tr>
                 <th scope="col" class="sort" data-sort="image">S No.</th>
                 <th scope="col" class="sort" data-sort="image">Product Image</th>
                 <th scope="col" class="sort" data-sort="name">Product Name</th>
                 <th scope="col" class="sort" data-sort="name">Category Name</th>
                 <th scope="col" class="sort" data-sort="name">Sub Category Name</th>
                 <th scope="col" class="sort" data-sort="status">Status</th>
                 <th scope="col" class="sort" data-sort="action">Action</th>
               </tr>
             </thead>
             <tbody class="list">
               @if(isset($productlist)) 
               @foreach($productlist as $list)
               <tr>
                   <td>{{ $loop->iteration }}</td>
                   <td><img src="{{ asset('categoryimg/'.$list->cat_img ) }}" class="img-fluid" style="width: 100px;"></td>
                   <td>{{ $list->cat_name }}</td>
                   <td>{{ ($list->status==1)?"active":"In active" }}</td>
                   <td>
                     <a href="" class="me-2 btn btn-primary btn-sm"><i class="fas fa-eye"></i>
                     </a>
                     <a href="{{ route('catdelete',base64_encode($list->id))}}"  class="btn btn-danger me-2 btn-sm"><i class="fas fa-trash"></i>
                     </a>
                     <a href="{{ route('editcategory',base64_encode($list->id))}}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i>
                     </a>
                   </td> 
                   <td></td>
                   <td></td>                  
               </tr>
                @endforeach
                @endif
             </tbody>
           </table>
        </div>
        <div class="tab-pane fade" id="cat" role="tabpanel" aria-labelledby="cat-tab">
         <form action="{{ route('addcategory') }}" method="post" enctype="multipart/form-data">
          @csrf
             <div class="row">
                <div class="col-md-4">
                  <div class="mb-3">
                    <label class="form-label" for="validationCustom01">Select Category</label>
                    <select class="form-select" name="catid" id="parentcat">
                       @if($catlist)
                       @foreach($catlist as $value)
                       <option value="{{ $value->id }}">{{ $value->cat_name }}</option>
                       @endforeach
                       @endif
                     </select>
                  </div>
                </div>
                 <div class="col-md-4">
                  <div class="mb-3">
                    <label class="form-label" for="validationCustom01">Select Sub Category</label>
                     <select class="form-select" name="subcatid" id="subcategory">
                       <option>Selct Sub Category</option>
                     </select>
                  </div>
                </div>
               <div class="col-md-4">
                 <div class="mb-3">
                   <label class="form-label" for="validationCustom01">Product Name</label>
                   <input name="product_name" type="text" class="form-control" id="validationCustom01" placeholder="Product name" required="">
                    @error('product_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                 </div>
               </div>
               <div class="col-md-12">
                 <div class="mb-3">
                   <label class="form-label" for="validationCustom02">Description</label>
                   <textarea name="product_des" required="" class="form-control" placeholder="Description" rows="5"></textarea>
                   @error('cat_des')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                 </div>
               </div>

                <div class="col-md-3">
                 <div class="mb-3">
                   <label class="form-label" for="validationCustom02">Regular Price (Rs.) *</label>
                  <input type="number" name="regprice" class="form-control">
                   @error('regprice')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                 </div>
                </div>
                <div class="col-md-3">
                 <div class="mb-3">
                   <label class="form-label" for="validationCustom02">Sale Price (Rs.) *</label>
                  <input type="number" name="saleprice" class="form-control">
                   @error('saleprice')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                 </div>
                </div>

                <div class="col-md-3">
                 <div class="mb-3">
                  <label class="form-label" for="validationChech">Stock Unlimited</label>
                  <input type="checkbox" name="check" id="validationChech">
                 </div>
                </div>
                <div class="col-md-3">
                 <div class="mb-3">
                  <label class="form-label" for="stock">Stock Quntity *</label>
                  <input type="number" name="stock" class="form-control" id="stock" disabled>
                 </div>
                </div>

                 <div class="col-md-12">
                   <div class="mb-3">
                     <div class="w-100 d-flex file-drop-area flex-column justify-content-center">
                        <span class="choose-file-button">The higher the resolution, the better your upload will look on your gear.</span>
                        <span class="file-message">Drag and drop <span style="color: blue;">Browse</span> Your Computer</span>
                        <input class="file-input" type="file" name="product_img">
                        @error('cat_img')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                       @enderror
                      </div>
                   </div>
                 </div>
                 <div class="col-md-12">
                   <div class="mb-3">
                     <label class="form-label" for="validationCustom02">Status</label>
                       <select class="form-select" name="status">
                         <option value="1">Active</option>
                         <option value="0">In Active</option>
                       </select>
                       @error('status')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                   </div>
                 </div>
                </div>
                 <button class="btn btn-primary" type="submit">Submit form</button>
               </form>
             </div>
           </div>
         </div>

       </div>
     </div>
   </div>
   @endsection

