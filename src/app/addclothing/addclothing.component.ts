import { Component, Directive } from '@angular/core';
import { FormGroup, FormControl } from '@angular/forms';
import { Http, Response, Headers } from '@angular/http';
import { Observable } from 'rxjs/Observable';

import {Router} from '@angular/router';

@Component({
  selector: 'AddClothingComponent',
  templateUrl: './addclothing.html',
})
export class AddClothingComponent {
  http: Http;
  router: Router;
  postResponse: Response;
  addClothingForm = new FormGroup({
    type: new FormControl(),
    price: new FormControl()
  });
constructor(http: Http, router: Router) {
  this.http = http;
  this.router = router;
}

onAddClothing(): void {
  var data = "type=" + this.addClothingForm.value.type + "&& price=" + this.addClothingForm.value.price;
  var headers = new Headers();
  headers.append('Content-Type', 'application/x-www-form-urlencoded');
  headers.append("token", localStorage.getItem("token"));
  this.http.post('http://localhost/it255/addclothing.php', data, {headers:headers})
  .map(res => res)
  .subscribe(
    data => this.postResponse = data,
    err => alert(JSON.stringify(err)),
    () => {
      if(this.postResponse["_body"].indexOf("error") === -1){
        //this.router.navigate(['./allclothes']);
      } else{
        alert("Neuspesno dodavanje igre");
      }
    }
  );
}
}
