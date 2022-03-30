import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { AuthService } from '../shared/auth.service';
import { FormControl, FormGroup } from '@angular/forms';

@Component({
  selector: 'app-main',
  templateUrl: './main.component.html',
  styleUrls: ['./main.component.css']
})
export class MainComponent implements OnInit {
  
  ads:any;
  books:any = [];
  searchForm!:FormGroup;

  host = 'http://localhost:8000/api/';
  server = 'http://localhost:8000';


  constructor(
    private router: Router,
    private http: HttpClient,
    private auth: AuthService
  ) { }

  ngOnInit(): void {
    this.getMyAds();
    this.searchForm = new FormGroup({
      search: new FormControl('')
    })
  }
  getMyAds(){
    let endpoint = 'web/advertisements';
    let url = this.host + endpoint;
    
    this.http.get<any>(url)
    .subscribe(
      (res) => {
        console.log(res.data)
        this.ads = res.data;
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
    let writer;
    for(let book of this.books){
      if(book.id == book_id){
        writer = book.writer;
        title = book.title;
      }
    }
    return writer+": "+title;
  }
  navigateAd(id:any){
    this.router.navigate(['advertisement/', id]);
  }
  search(){
    let searchData = {
      adtitle: this.searchForm.value.search
    }
    let endpoint = 'web/advertisements/filter';
    let url = this.host + endpoint;

    let data = JSON.stringify(searchData);

    let headerObj = new HttpHeaders({
      'Content-Type':'application/json'
    })
    let header = {
      headers: headerObj
    }

    this.http.post<any>(url,data, header)
    .subscribe(
      (res) => {
        let ads:any = [];
        for(let ad of res.data){   
          this.getBook(ad[0].book_id);
          ads.push(ad[0]);
        }
        this.ads = ads
        console.log(this.ads)
      }, (error) => {
        console.error(error);
        alert('Nincs találat a keresésre!');
    });
  }
}
