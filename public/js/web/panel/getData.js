import { FetchServiceProvider } from '../../Providers/FetchServiceProvider.js';

export async function getData(URL, LocalStorageInstance){
    let headers = {
        "Content-Type": "application/json",
        'Authorization': `Bearer ${JSON.parse(LocalStorageInstance.data)}`,
    }
    let FetchInstance = await FetchServiceProvider.getData(URL, headers);
    return FetchInstance.getResponse('data');
}