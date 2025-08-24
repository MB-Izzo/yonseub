import { SharedData, type BreadcrumbItem } from '@/types';
import { Form, usePage } from '@inertiajs/react';
import { type ReactNode } from 'react';

interface MainLayoutProps {
    children: ReactNode;
    title: ReactNode;
    //    breadcrumbs?: BreadcrumbItem[];
}

export const MainLayout = ({ children, title, ...props }: MainLayoutProps) => {
    const { url } = usePage();
    const { auth } = usePage<SharedData>().props;
    return (
        <div className='min-h-full'>
            <nav className='bg-gray-800'>
                <div className='mx-auto max-w-7xl px-4 sm:px-6 lg:px-8'>
                    <div className='flex h-16 items-center justify-between'>
                        <div className='flex items-center'>
                            <div className='shrink-0'>
                                <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company" className="size-8" />
                            </div>
                            <div className='md:block hidden'>
                                <div className='ml-10 flex items-baseline space-x-4'>
                                    <a href={auth.user ? '/app' : '/'} className={url === '/' || url === '/app' ? 'rounded-md bg-gray-950/50 px-3 py-2 text-sm font-medium text-white' : 'rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white'}>Home</a>
                                    {!auth.user ? (
                                        <>
                                            <a href='/login' className={url === '/login' ? 'rounded-md bg-gray-950/50 px-3 py-2 text-sm font-medium text-white' : 'rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white'}>Login</a>
                                            <a href='/register' className={url === '/register' ? 'rounded-md bg-gray-950/50 px-3 py-2 text-sm font-medium text-white' : 'rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white'}>Register</a>
                                        </>
                                    ) : (
                                        <>
                                            <a href='/words' className={url === '/words' ? 'rounded-md bg-gray-950/50 px-3 py-2 text-sm font-medium text-white' : 'rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white'}>Words</a>
                                            <a href='/my-exercises' className={url === '/my-exercises' ? 'rounded-md bg-gray-950/50 px-3 py-2 text-sm font-medium text-white' : 'rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white'}>My exercises</a>
                                            <Form method='POST' action={route('logout')} >
                                                <button className='rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white hover:cursor-pointer'>Logout</button>
                                            </Form>
                                        </>
                                    )}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav >
            <header className="relative bg-gray-800 after:pointer-events-none after:absolute after:inset-x-0 after:inset-y-0 after:border-y after:border-white/10">
                <div className="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                    <h1 className="text-3xl font-bold tracking-tight text-white">{title || "Need title"}</h1>
                </div>
            </header>
            <main>
                <div className="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                    {children}
                </div>
            </main>

        </div >
    )
};
