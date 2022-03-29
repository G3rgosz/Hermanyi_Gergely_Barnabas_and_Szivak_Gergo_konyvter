import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { AuthService } from '../shared/auth.service';
import { ThisReceiver } from '@angular/compiler';
@Component({
  selector: 'app-myadvertisements',
  templateUrl: './myadvertisements.component.html',
  styleUrls: ['./myadvertisements.component.css']
})
export class MyadvertisementsComponent implements OnInit {

  myads:any;
  books:any = [];

  host = 'http://localhost:8000/api/';
  server = 'http://localhost:8000';

  constructor(
    private router: Router,
    private http: HttpClient,
    private auth: AuthService
  ) { }

  ngOnInit(): void {
    this.getMyAds();
  }
  getMyAds(){
    let endpoint = 'web/advertisements/my';
    let url = this.host + endpoint;
    
    let token = this.auth.isLoggedIn();

    let headerObj = new HttpHeaders({
      'Authorization': `Bearer ${token}`
    })
    let header = {
      headers: headerObj
    }
    this.http.get<any>(url,header)
    .subscribe(
      (res) => {
        this.myads = res.data;
        for(let ad of res.data){
          this.getBook(ad.book_id);
        }
      }, (error) => {
        console.error(error);
    });
  }
  getBook(book_id:any){
    let endpoint = 'web/books/';
    let url = this.host + endpoint + book_id;
    this.http.get<any>(url)
    .subscribe(
      (res) => {
        this.books.push(res.data[0]);
      }, (error) => {
        console.error(error);
    });
  }
  getBookTitle(book_id:any){
    let title;
    for(let book of this.books){
      if(book.id == book_id){
        title = book.title;
      }
    }
    return title;
  }
  navigateAd(id:any){
    this.router.navigate(['advertisement/', id]);
  }
  delete(id:any){
    let endpoint = 'web/advertisements/';
    let url = this.host + endpoint + id;
    
    let token = this.auth.isLoggedIn();

    let headerObj = new HttpHeaders({
      'Authorization': `Bearer ${token}`
    })
    let header = {
      headers: headerObj
    }
    this.http.delete<any>(url,header)
    .subscribe(
      (res) => {
        location.reload();
      }, (error) => {
        console.error(error);
    });
  }
}
