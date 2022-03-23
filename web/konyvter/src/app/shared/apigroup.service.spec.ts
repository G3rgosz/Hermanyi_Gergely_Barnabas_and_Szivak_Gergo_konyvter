import { TestBed } from '@angular/core/testing';

import { ApigroupService } from './apigroup.service';

describe('ApigroupService', () => {
  let service: ApigroupService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(ApigroupService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
