import PageTitle from "../../shared-kernel/components/PageTitle/PageTitle";
import Card, {CardTitle} from "../../shared-kernel/components/Card/Card";
import {PlusIcon} from "@heroicons/react/20/solid";
import {NavLink} from "react-router-dom";
import {useQuery} from "@tanstack/react-query";
import Providers from "../repositories/Providers";
import Loading from "../../shared-kernel/components/Loading/Loading";

const ProviderIndex = () => {
    const {data: providers, isFetching} = useQuery({
        queryKey: ['providers'],
        queryFn: Providers.findAll
    });

    return(
        <>
            <PageTitle text='Provider' />

            <Card>
                {isFetching ? <Loading color='grey' /> : (
                    <div className='columns-2 md:columns-6 gap-2'>
                        <NavLink to='/admin/provider/new'>
                            <div className='flex flex-col h-32 gap-2 items-center p-2 mb-2 break-inside-avoid-column border border-gray-100 rounded hover:shadow-md'>
                                <PlusIcon className='size-24' />
                                Anlegen
                            </div>
                        </NavLink>
                        {providers?.map(provider => (
                            <NavLink key={provider.id} to={`/admin/provider/${provider.id}`}>
                                <div className='flex flex-col h-32 gap-2 items-center justify-between p-2 mb-2 break-inside-avoid-column border border-gray-100 rounded hover:shadow-md'>
                                    <img src={provider.logoImage} alt='provider logo'/>
                                    {provider.name}
                                </div>
                            </NavLink>
                        ))}
                    </div>
                )}
            </Card>
        </>
    );
}

export default ProviderIndex;
